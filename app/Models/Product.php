<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','size_id','name', 'price', 'quantity', 'description'];

    public function ImageProducts() {
        return $this->hasMany('App\Models\ImageProduct');
    }
    
    public function Size() {
        return $this->belongsTo('App\Models\Size');
    }
}
