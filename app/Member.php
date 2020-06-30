<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ["nim","full_name","phone","address", "gender"];

    public function loans()
    {
        return $this->hasMany("App\Loan");
    }
}
