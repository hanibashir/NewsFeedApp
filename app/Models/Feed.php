<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

}
