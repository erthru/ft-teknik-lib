<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ["code","title","isbn_issn","classification","publication_year","type","author_name"];

    public function loans()
    {
        return $this->hasMany("App\Loan");
    }
}
