<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function feed()
    {
        return $this->belongsTo('App\Models\Feed');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category'] ?? false, fn ($query, $categoryName) =>
            $query->whereHas('category', fn ($query) =>
                $query->where('name', $categoryName)));

        $query->when($filters['source'] ?? false, fn ($query, $sourceName) =>
            $query->whereHas('feed', fn ($query) =>
                $query->where('feed_name', $sourceName)));
    }
}
