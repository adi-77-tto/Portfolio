<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $table = 'research';
    
    protected $fillable = [
        'title',
        'description',
        'abstract',
        'team_members',
        'status',
        'year',
        'paper_link',
        'pdf_file',
        'image',
        'sort_order',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    public static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderByDesc('year')->orderBy('sort_order');
        });
    }
}
