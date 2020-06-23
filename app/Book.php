<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ["code","title","isbn_issn","classification","publication_year","author_name"];

    public function loans()
    {
        return $this->hasMany("App\Loan");
    }
}
