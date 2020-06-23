<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ["username","password"];

    public function loans()
    {
        return $this->hasMany("App\Loan");
    }
}
