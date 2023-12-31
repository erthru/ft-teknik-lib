<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Item;
use App\Loan;
use App\Member;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function itemHome(Request $request)
    {
        $mostLoanItems = Item::select("*")->selectSub("SELECT COUNT(id) FROM loans WHERE item_id = items.id", "counted_loan")->orderBy("counted_loan", "DESC")->take(5)->get();
        
        $data = [
            "mostLoanItems" => $mostLoanItems
        ];

        return view("main.home", $data);
    }

    public function itemSearch(Request $request)
    {
        $items = Item::with(["loans" => function($loans) {
            $loans->whereRaw("returned_date IS NULL");
        }])->where("title", "LIKE", "%".$request->query("q")."%")
        ->orWhere("author_name", "LIKE", "%".$request->query("q")."%")
        ->orderBy("title", "ASC")
        ->paginate(20);

        $data = [
            "items" => $items
        ];

        return view("main.search", $data);
    }
    
    public function book(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.book");
    }

    public function bookAdd(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.book_add");
    }
    
    public function bookAddAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
            'isbn_issn' => 'required',
            'classification' => 'required',
            'publication_year' => 'required',
            'author_name' => 'required',
        ])->validate();

        $file = "";

        if($request->hasFile("file")){
            $file = uniqid().".".$request->file("file")->getClientOriginalExtension();
            $request->file("file")->move("file", $file);
        }

        $body = [
            "code" => $request->input("code"),
            "title" => $request->input("title"),
            "isbn_issn" => $request->input("isbn_issn"),
            "classification" => $request->input("classification"),
            "publication_year" => $request->input("publication_year"),
            "type" => "BOOK",
            "author_name" => $request->input("author_name"),
            "file" => $file
        ];

        $check = Item::where("code", $request->input("code"))
        ->where("title", $request->input("title"))
        ->where("isbn_issn", $request->input("isbn_issn"))
        ->where("classification", $request->input("classification"))
        ->where("publication_year", $request->input("publication_year"))
        ->where("type", "BOOK")
        ->where("author_name", $request->input("author_name"))
        ->first();

        if($check) {
            return redirect("/admin/book/add")->with("error", "Data buku dengan kode tersebut telah ada. Gunakan kode yang lain.")->withInput();
        }else{
            Item::create($body);
            return redirect("/admin/book")->with("success", "Buku berhasil ditambahkan.");
        }
    }

    public function bookDetail(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $item = Item::findOrFail($request->query("id"));

        $items = Item::with(["loans" => function($loans) {
            $loans->whereRaw("returned_date IS NULL");
        }])
        ->where("title", $item->title)
        ->where("isbn_issn", $item->isbn_issn)
        ->where("classification", $item->classification)
        ->where("publication_year", $item->publication_year)
        ->where("type", "BOOK")
        ->where("author_name", $item->author_name)
        ->get();

        $data = [
            "item" => $item,
            "items" => $items
        ];

        return view("admin.book_detail", $data);
    }

    public function bookUpdateAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $item = Item::findOrFail($request->query("id"));

        Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
            'isbn_issn' => 'required',
            'classification' => 'required',
            'publication_year' => 'required',
            'author_name' => 'required',
        ])->validate();

        $file = $item->file ?: "";

        if(empty($item->file)){
            if($request->hasFile("file")){
                $file = uniqid().".".$request->file("file")->getClientOriginalExtension();
                $request->file("file")->move("file", $file);
            }
        }

        $body = [
            "code" => $request->input("code"),
            "title" => $request->input("title"),
            "isbn_issn" => $request->input("isbn_issn"),
            "classification" => $request->input("classification"),
            "publication_year" => $request->input("publication_year"),
            "type" => "BOOK",
            "author_name" => $request->input("author_name"),
            "file" => $file
        ];

        $check = Item::where("code", $request->input("code"))
        ->where("title", $request->input("title"))
        ->where("isbn_issn", $request->input("isbn_issn"))
        ->where("classification", $request->input("classification"))
        ->where("publication_year", $request->input("publication_year"))
        ->where("type", "BOOK")
        ->where("author_name", $request->input("author_name"))
        ->first();

        if($request->input("code") == $item->code && $request->input("title") == $item->title && $request->input("isbn_issn") == $item->isbn_issn && $request->input("classification") == $item->classification && $request->input("publication_year") == $item->publication_year && $request->input("author_name") == $item->author_name){
            $item->update($body);
            return redirect("/admin/book");
        }else{
            if($check){
                return redirect("/admin/book/detail?id=".$request->query("id"))->with("error", "Data buku dengan kode tersebut telah ada. Gunakan kode yang lain.")->withInput();
            }else{
                $item->update($body);
                return redirect("/admin/book")->with("success", "Buku berhasil diperbarui.");
            }
        }
    }

    public function bookDeleteAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $item = Item::findOrFail($request->query("id"));
        
        if(!empty($item->file)){
            unlink("file/" . $item->file);
        }

        $item->delete();

        return redirect("/admin/book")->with("success", "Buku berhasil dihapus.");
    }

    public function bookDeleteFileAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $item = Item::findOrFail($request->query("id"));
        
        unlink("file/" . $item->file);
        
        $body = [
            "file" => ""
        ];
        
        $item->update($body);

        return redirect("/admin/book/detail?id=".$item->id)->withInput();
    }

    public function essay(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.essay");
    }

    public function essayAdd(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.essay_add");
    }
    
    public function essayAddAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
            'publication_year' => 'required',
            'author_name' => 'required',
        ])->validate();

        $file = "";

        if($request->hasFile("file")){
            $file = uniqid().".".$request->file("file")->getClientOriginalExtension();
            $request->file("file")->move("file", $file);
        }

        $body = [
            "code" => $request->input("code"),
            "title" => $request->input("title"),
            "publication_year" => $request->input("publication_year"),
            "type" => "ESSAY",
            "author_name" => $request->input("author_name"),
            "file" => $file
        ];

        $check = Item::where("code", $request->input("code"))
        ->where("title", $request->input("title"))
        ->where("publication_year", $request->input("publication_year"))
        ->where("type", "ESSAY")
        ->where("author_name", $request->input("author_name"))
        ->first();

        if($check){
            return redirect("/admin/essay/add")->with("error", "Data skripsi dengan kode tersebut telah ada. Gunakan kode yang lain.")->withInput();
        }else{
            Item::create($body);
            return redirect("/admin/essay")->with("success", "Skripsi berhasil ditambahkan.");
        }
    }

    public function essayDetail(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $item = Item::findOrFail($request->query("id"));

        $items = Item::with(["loans" => function($loans) {
            $loans->whereRaw("returned_date IS NULL");
        }])
        ->where("title", $item->title)
        ->where("publication_year", $item->publication_year)
        ->where("type", "ESSAY")
        ->where("author_name", $item->author_name)
        ->get();

        $data = [
            "item" => $item,
            "items" => $items
        ];

        return view("admin.essay_detail", $data);
    }

    public function essayUpdateAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $item = Item::findOrFail($request->query("id"));

        Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
            'publication_year' => 'required',
            'author_name' => 'required',
        ])->validate();

        $file = $item->file ?: "";

        if(empty($item->file)){
            if($request->hasFile("file")){
                $file = uniqid().".".$request->file("file")->getClientOriginalExtension();
                $request->file("file")->move("file", $file);
            }
        }

        $body = [
            "code" => $request->input("code"),
            "title" => $request->input("title"),
            "publication_year" => $request->input("publication_year"),
            "type" => "ESSAY",
            "author_name" => $request->input("author_name"),
            "file" => $file
        ];

        $check = Item::where("code", $request->input("code"))
        ->where("title", $request->input("title"))
        ->where("publication_year", $request->input("publication_year"))
        ->where("type", "ESSAY")
        ->where("author_name", $request->input("author_name"))
        ->first();

        if($request->input("code") == $item->code && $request->input("title") == $item->title && $request->input("classification") == $item->classification && $request->input("publication_year") == $item->publication_year && $request->input("author_name") == $item->author_name){
            $item->update($body);
            return redirect("/admin/essay");
        }else{
            if($check){
                return redirect("/admin/essay/detail?id=".$request->query("id"))->with("error", "Data buku dengan kode tersebut telah ada. Gunakan kode yang lain.")->withInput();
            }else{
                $item->update($body);
                return redirect("/admin/essay")->with("success", "Skripsi berhasil diperbarui.");
            }
        }
    }

    public function essayDeleteAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $item = Item::findOrFail($request->query("id"));

        if(!empty($item->file)){
            unlink("file/" . $item->file);
        }

        $item->delete();

        return redirect("/admin/essay")->with("success", "Skripsi berhasil dihapus.");
    }

    public function essayDeleteFileAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $item = Item::findOrFail($request->query("id"));
        
        unlink("file/" . $item->file);
        
        $body = [
            "file" => ""
        ];
        
        $item->update($body);

        return redirect("/admin/essay/detail?id=".$item->id)->withInput();
    }

    public function dataItemSearchItemAvailableToBorrowJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $itemIds = "";
        
        $itemsSearched = Item::where("title", "LIKE", "%".$request->query("key")."%")->take(7)->get();
        
        foreach($itemsSearched as $item){
            $itemIds .= $item->id.",";
        }

        $itemIds = substr($itemIds, 0, -1) ?: "0";

        return Item::whereRaw("(code LIKE '%".$request->query("key")."%' OR title LIKE '%".$request->query("key")."%' OR isbn_issn LIKE '%".$request->query("key")."%') AND id NOT IN (SELECT item_id FROM loans WHERE item_id IN (".$itemIds.") AND returned_date IS NULL)")
        ->take(5)
        ->get();
    }

    public function dataTableBookGroupByAllExculeCodeJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return Datatables::of(Item::where("type", "BOOK")
        ->groupByRaw("title,isbn_issn,classification,publication_year,author_name")
        ->get())
        ->make();
    }

    public function dataTableEssayGroupByAllExculeCodeJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }
        
        return Datatables::of(Item::where("type", "ESSAY")
        ->groupByRaw("title,publication_year,author_name")
        ->get())
        ->make();
    }
}
