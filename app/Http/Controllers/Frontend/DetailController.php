<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Product\ProductRepositoryInterface; 
use App\Repositories\ImageProduct\ImageProductRepositoryInterface; 
use Session;
use Exception;
use Auth;
use App\Library\Cart;


class DetailController extends Controller
{
    //
    protected $product;
    protected $image_product;
    public function __construct(ProductRepositoryInterface $product, ImageProductRepositoryInterface $image_product)
    {
        $this->product = $product;
        $this->image_product = $image_product;
    }

    public function addInCart(Request $request, $id) {
        $product = $this->product->find($id);
        $oldCart = Session('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $qty = $request->qty > 0 ? $request->qty : 1;
        $cart->add($product, $id, $qty);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
}
