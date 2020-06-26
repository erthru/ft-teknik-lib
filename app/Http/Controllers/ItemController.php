<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Item;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next){
            if(!$request->session()->get("id")){
                return redirect("/admin/login");
            }

            return $next($request);
        });
    }

    public function indexBook(Request $request)
    {
        return view("admin.book");
    }

    public function addBook(Request $request)
    {
        return view("admin.book_add");
    }
    
    public function addBookAction(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'isbn_issn' => 'required',
            'classification' => 'required',
            'publication_year' => 'required',
            'author_name' => 'required',
        ])->validate();

        $body = [
            "title" => $request->input("title"),
            "isbn_issn" => $request->input("isbn_issn"),
            "classification" => $request->input("classification"),
            "publication_year" => $request->input("publication_year"),
            "type" => "BOOK",
            "author_name" => $request->input("author_name")
        ];

        Item::create($body);
        return redirect("/admin/book")->with("success", "Buku berhasil ditambahkan.");
    }

    public function detailBook(Request $request)
    {
        $item = Item::findOrFail($request->query("id"));
        $data = [
            "item" => $item
        ];

        return view("admin.book_detail", $data);
    }

    public function updateBookAction(Request $request)
    {
        $item = Item::findOrFail($request->query("id"));

        Validator::make($request->all(), [
            'title' => 'required',
            'isbn_issn' => 'required',
            'classification' => 'required',
            'publication_year' => 'required',
            'author_name' => 'required',
        ])->validate();

        $body = [
            "title" => $request->input("title"),
            "isbn_issn" => $request->input("isbn_issn"),
            "classification" => $request->input("classification"),
            "publication_year" => $request->input("publication_year"),
            "type" => "BOOK",
            "author_name" => $request->input("author_name")
        ];

        $item->update($body);
        return redirect("/admin/book")->with("success", "Buku berhasil diperbarui.");
    }

    public function deleteBookAction(Request $request)
    {
        $item = Item::findOrFail($request->query("id"));
        $item->delete();

        return redirect("/admin/book")->with("success", "Buku berhasil dihapus.");
    }

    public function dataTableBook(Request $request)
    {
        return Datatables::of(Item::where("type", "BOOK")->orderBy("id", "DESC")->get())->make();
    }
}
