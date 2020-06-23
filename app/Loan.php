<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ["borrowed_date","due_date","book_id","member_id","admin_id"];

    public function book()
    {
        return $this->belongsTo("App\Book");
    }

    public function member()
    {
        return $this->belongsTo("App\Member");
    }

    public function admin()
    {
        return $this->belongsTo("App\Admin");
    }
}
