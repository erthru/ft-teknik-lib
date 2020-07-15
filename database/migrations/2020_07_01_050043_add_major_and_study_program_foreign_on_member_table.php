<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMajorAndStudyProgramForeignOnMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->unsignedBigInteger("major_id")->after("gender");
            $table->unsignedBigInteger("study_program_id")->after("major_id");
            $table->foreign("major_id")->references("id")->on("majors")->onDelete("cascade");
            $table->foreign("study_program_id")->references("id")->on("study_programs")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn("major_id");
            $table->dropColumn("study_program_id");
        });
    }
}
