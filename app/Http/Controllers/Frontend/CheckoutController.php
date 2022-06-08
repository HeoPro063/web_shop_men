<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Auth;
use Session;
use App\Library\Cart;
use HoangPhi\VietnamMap\Models\Province;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Ward;
use App\Models\Order;
use App\Models\OrderDetail;
class CheckoutController extends Controller
{
    //
    public function getCheckout() {
        $user = Auth::check() ? Auth::user() : null;
        $address = Address::where('user_id',$user->id)->where('active', true)->first();
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $dataCart = $cart->getCart();
        $dataVt = [
            'province' => Province::all(),
            'district' => District::all(),
            'ward' => Ward::all(),
        ];
        return view('frontend.pages.checkout', compact('address', 'dataCart', 'dataVt'));
    } 
    
    public function postCheckout(Request $request) {
        $user = Auth::check() ? Auth::user() : null;
        $Order = new Order;
        $Order->user_id = $user->id;
        $Order->name = $request->name;
        $Order->phone = $request->phone;
        $Order->total_price = $request->carts['totalPrice'];
        $Order->total_qty = $request->carts['totalQty'];
        $province = Province::find($request->province_id);
        $district = District::find($request->district_id);
        $ward = Ward::find($request->ward_id);
        $address = $request->specific_address.' - '.$ward->name.' - '.$district->name.' - '.$province->name;
        $Order->address = $address;   
        $Order->status =  0;
        $Order->active = 1;
        if($Order->save()) {
            foreach ($request->carts['items'] as $key => $value) {
                $orderDetail =  new OrderDetail;
                $orderDetail->order_id = $Order['id'];
                $orderDetail->color = $value['color'];
                $orderDetail->name = $value['name'];
                $orderDetail->size = $value['size'];
                $orderDetail->price = $value['price'];
                $orderDetail->quantity = $value['qty'];
                $orderDetail->image = $value['image'];
                $orderDetail->save();
            }
        }
          Session::forget('cart');
          return response()->json([
              'status' => 200,
              'message' => 'success',
          ]);
    }
}
