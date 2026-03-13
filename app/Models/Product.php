<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name_ku', 'name_en', 'description_ku', 'price', 'image', 'is_featured', 'is_active'];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
