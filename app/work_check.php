<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class work_check extends Model
{
    protected $guarded = [];

    public function user()
    {
        $this->belongsTo('App\User','user_id','user_id');
    }
}

