<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ["nim","full_name","phone","address", "gender", "major_id", "study_program_id"];

    public function major()
    {
        return $this->belongsTo("App\Major");
    }

    public function StudyProgram()
    {
        return $this->belongsTo("App\StudyProgram");
    }

    public function loans()
    {
        return $this->hasMany("App\Loan");
    }
}
