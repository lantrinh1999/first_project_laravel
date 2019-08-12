<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'image',
        'status',
        'description',
        'create_at',
        'update_at',
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product_category');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'product_id', 'id');
    }
}
