<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'create_at',
        'update_at',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_category');
    }
}
