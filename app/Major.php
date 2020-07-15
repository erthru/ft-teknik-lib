<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = ["name"];

    public function studyPrograms()
    {
        return $this->hasMany("App\StudyProgram");
    }
}
