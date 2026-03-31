<?php

namespace App\Models;
use app\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

}



