<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{

    use HasFactory;
    protected $fillable = ['name', 'percent', 'start_date', 'end_date'];
    protected $dates = ['start_date', 'end_date'];
    public function Products() {
        return $this->hasMany('App\Models\Product');
    }
}
