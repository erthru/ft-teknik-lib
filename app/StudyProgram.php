<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    protected $fillable = ["name","major_id"];

    public function major()
    {
        return $this->belongsTo("App\Major");
    }
}
