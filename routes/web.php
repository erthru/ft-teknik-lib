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
    Route::get("", "AdminController@index");
    Route::get("login", "AdminController@login");
    Route::get("logout", "AdminController@logoutAction");
    Route::post("login", "AdminController@loginAction");

    Route::prefix("book")->group(function (){
        Route::get("", "ItemController@book");
        Route::get("add", "ItemController@addBook");
        Route::get("detail", "ItemController@detailBook");
        Route::get("datatable/group_by_all_exclude_code", "ItemController@dataTableBookGroupByAllExculeCodeJSON");
        Route::get("delete", "ItemController@deleteBookAction");
        Route::post("add", "ItemController@addBookAction");
        Route::post("update", "ItemController@updateBookAction");
    });

    Route::prefix("essay")->group(function (){
        Route::get("", "ItemController@essay");
        Route::get("add", "ItemController@addEssay");
        Route::get("detail", "ItemController@detailEssay");
        Route::get("datatable/group_by_all_exclude_code", "ItemController@dataTableEssayGroupByAllExculeCodeJSON");
        Route::get("delete", "ItemController@deleteEssayAction");
        Route::post("add", "ItemController@addEssayAction");
        Route::post("update", "ItemController@updateEssayAction");
    });

    Route::prefix("member")->group(function (){
        Route::get("", "MemberController@member");
        Route::get("add", "MemberController@addMember");
        Route::get("detail", "MemberController@detailMember");
        Route::get("datatable/default", "MemberController@dataTableMember");
        Route::get("delete", "MemberController@deleteMemberAction");
        Route::post("add", "MemberController@addMemberAction");
        Route::post("update", "MemberController@updateMemberAction");
    });

    Route::prefix("loan")->group(function (){
        Route::get("", "LoanController@loan");
        Route::get("datatable/default", "LoanController@dataTableLoan");
        Route::get("datatable/active", "LoanController@dataTableLoanActive");
        Route::get("datatable/finish", "LoanController@dataTableLoanFinish");
    });
});
