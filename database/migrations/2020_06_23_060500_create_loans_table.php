<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->date("borrowed_date");
            $table->date("due_date");
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("member_id");
            $table->unsignedBigInteger("admin_id");
            $table->timestamps();
        });

        Schema::table("loans", function (Blueprint $table) {
            $table->foreign("book_id")->references("id")->on("books")->onDelete("cascade");
            $table->foreign("member_id")->references("id")->on("members")->onDelete("cascade");
            $table->foreign("admin_id")->references("id")->on("admins")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
