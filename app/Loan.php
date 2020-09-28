<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ["borrowed_date","due_date","returned_date","is_lost","fine","is_paid","item_id","member_id","admin_id"];

    public function item()
    {
        return $this->belongsTo("App\Item");
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
