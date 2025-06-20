<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_available',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
