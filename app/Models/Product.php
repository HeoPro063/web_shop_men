<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'promotion_id' , 'name', 'price', 'quantity', 'purchases', 'description'];

    public function ImageProducts() {
        return $this->hasMany('App\Models\ImageProduct');
    }
    
    public function Size() {
        return $this->belongsTo('App\Models\Size');
    }

    public function Promotion() {
        return $this->belongsTo('App\Models\Promotion');
    }

    public function ProductColors() {
        return $this->hasMany('App\Models\ProductColor');
    }

    public function ProductSizes() {
        return $this->hasMany('App\Models\ProductSize');
    }
}
