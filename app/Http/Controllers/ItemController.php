<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        return view("admin.book");
    }

    public function add(Request $request)
    {
        return view("admin.add_book");
    }
    
    public function addAction(Request $request)
    {
        Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
            'isbn_issn' => 'required',
            'classification' => 'required',
            'publication_year' => 'required',
            'author_name' => 'required',
        ])->validate();

        $body = [
            "code" => $request->input("code"),
            "title" => $request->input("title"),
            "isbn_issn" => $request->input("isbn_issn"),
            "classification" => $request->input("classification"),
            "publication_year" => $request->input("publication_year"),
            "type" => "BOOK",
            "author_name" => $request->input("author_name")
        ];

        $item = Item::where("code", $request->input("code"))->first();

        if($item){
            return redirect("/admin/book/add")->with("error", "Kode buku telah ada.")->withInput();
        }else{
            Item::create($body);
            return redirect("/admin/book")->with("success", "Buku berhasil ditambahkan.");
        }
    }
}
