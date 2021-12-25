<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    public function feeds()
    {
        return $this->hasMany('App\Models\Feed');
    }
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
}
