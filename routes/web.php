<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function(){
    return "It Works!!";
});

Route::prefix("admin")->group(function (){
    Route::get("", "AdminController@admin");
    Route::get("login", "AdminController@login");
    Route::get("logout", "AdminController@logoutAction");
    Route::post("login", "AdminController@loginAction");

    Route::prefix("book")->group(function (){
        Route::get("", "ItemController@book");
        Route::get("add", "ItemController@bookAdd");
        Route::get("detail", "ItemController@bookDetail");
        Route::get("delete", "ItemController@bookDeleteAction");
        Route::get("json/datatable/group_by_all_exclude_code", "ItemController@dataTableBookGroupByAllExculeCodeJSON");
        route::get("json/data/book_search_item_available_to_borrow","ItemController@dataItemSearchItemAvailableToBorrowJSON");
        Route::post("add", "ItemController@bookAddAction");
        Route::post("update", "ItemController@bookUpdateAction");
    });

    Route::prefix("essay")->group(function (){
        Route::get("", "ItemController@essay");
        Route::get("add", "ItemController@essayAdd");
        Route::get("detail", "ItemController@essayDetail");
        Route::get("delete", "ItemController@essayDeleteAction");
        Route::get("json/datatable/group_by_all_exclude_code", "ItemController@dataTableEssayGroupByAllExculeCodeJSON");
        route::get("json/data/essay_search_item_available_to_borrow","ItemController@dataItemSearchItemAvailableToBorrowJSON");
        Route::post("add", "ItemController@essayAddAction");
        Route::post("update", "ItemController@essayUpdateAction");
    });

    Route::prefix("major")->group(function (){
        Route::get("", "MajorController@major");
        Route::get("add", "MajorController@majorAdd");
        Route::get("detail", "MajorController@majorDetail");
        Route::get("delete", "MajorController@majorDeleteAction");
        Route::get("json/datatable", "MajorController@dataTableMajor");
        Route::post("add", "MajorController@majorAddAction");
        Route::post("update", "MajorController@majorUpdateAction");
    });

    Route::prefix("study_program")->group(function (){
        Route::get("json/data/by_major_id", "StudyProgramController@dataByMajorIdJSON");
    });

    Route::prefix("member")->group(function (){
        Route::get("", "MemberController@member");
        Route::get("add", "MemberController@memberAdd");
        Route::get("detail", "MemberController@memberDetail");
        Route::get("delete", "MemberController@memberDeleteAction");
        Route::get("json/data/search", "MemberController@dataMemberSearchJSON");
        Route::get("json/datatable", "MemberController@dataTableMemberJSON");
        Route::post("add", "MemberController@memberAddAction");
        Route::post("update", "MemberController@memberUpdateAction");
    });

    Route::prefix("loan")->group(function (){
        Route::get("", "LoanController@loan");
        Route::get("add", "LoanController@loanAdd");
        Route::get("detail", "LoanController@loanDetail");
        Route::get("set_returned", "LoanController@loanSetReturnedAction");
        Route::get("set_lost", "LoanController@loanSetLostAction");
        Route::get("json/datatable", "LoanController@dataTableLoan");
        Route::get("json/datatable/active", "LoanController@dataTableLoanActive");
        Route::get("json/datatable/finish", "LoanController@dataTableLoanFinish");
        Route::post("add", "LoanController@loanAddAction");
    });
});
