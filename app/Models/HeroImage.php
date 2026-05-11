<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroImage extends Model
{
    protected $fillable = ['image_path', 'description', 'sort_order'];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('sort_order');
        });
    }
}
