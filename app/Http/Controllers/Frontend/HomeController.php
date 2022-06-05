<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface; 

class HomeController extends Controller
{
    //

    protected $product;
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    public function index() {
        
        return view('frontend.pages.home');
    }

}
