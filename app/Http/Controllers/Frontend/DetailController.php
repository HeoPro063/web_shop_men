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

    public function detail($id) {
        // Session::forget('cart');
        $product = $this->product->find($id);
        $data_detail = $this->product->reposeDataDetail($product);
        $product_more =  $this->product->getMoreProduct($product);
        return view('frontend.pages.detail', compact('data_detail', 'product_more'));
    }

    public function postAddCart(Request $request) {
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $product = $this->product->find($request->id);
        $qty = $request->quantity > 0 ? $request->quantity : 1;
        $cart->add($product, $request->all(), $qty);
        $request->session()->put('cart', $cart->getCartBase());
        return response()->json([
            'datas' => $cart->getCart()
        ]);
    }

    public function getDeleteCart(Request $request) {
        $id = $request->get('id');
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        $CartBase = $cart->getCartBase();
        if(count($CartBase['items']) > 0) {
            Session::put('cart', $CartBase);
        }else {
            Session::forget('cart');
        }
        return response()->json([
            'datas' => $cart->getCart()
        ]);
    }
    
}
