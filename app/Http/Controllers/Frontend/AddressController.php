<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use HoangPhi\VietnamMap\Models\Province;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Ward;
use App\Models\Address;
use Auth;
class AddressController extends Controller
{
    //
    public function getDataProvince() {
        $datas = [];
        $datas = Province::all();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'datas' => $datas
        ]);
    }

    public function getDataDistricts(Request $request) {
        if($request->get('province_id')){
            $province = Province::find($request->get('province_id'));
            $datas =  $province->districts;
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'datas' => $datas
            ]);
        }
    }

    public function getDataWards(Request $request) {
        if($request->get('districts_id')){
            $districts = District::find($request->get('districts_id'));
            $datas = $districts->wards;
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'datas' => $datas
            ]);
        }
    }

    public function addMoreAddress(Request $request) {
        $datas = $request->all();
        $user  = Auth::check() ? Auth::user() : null;
        $address_add = new Address; 

        if($datas['address_default']) {
            $address_data = Address::where('user_id',$user->id)->get();
            if(count($address_data) > 0) {
                $address_data_default = Address::where('user_id',$user->id)->where('active', true)->first();
                $address_data_default->active = false;
                $address_data_default->save();
            }
            $address_add->active = true;
        }else {
            $address_add->active = true;
            $address_data = Address::where('user_id',$user->id)->get();
            if(count($address_data) > 0) {
                $address_add->active = false;
            }
        }

        $address_add->name = $datas['name'];
        $address_add->user_id = $datas['user_id'];
        $address_add->province_id = $datas['province_id'];
        $address_add->districts_id = $datas['districts_id'];
        $address_add->specific_address = $datas['specific_address'];
        $address_add->wards_id = $datas['wards_id'];
        $address_add->phone = $datas['phone'];

        $address_add->save();
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'datas' => $address_add
        ]);
    }

    public function getDataAddress() {
        $user  = Auth::check() ? Auth::user() : null;
        $address = Address::where('user_id', $user->id)->orderBy('active', 'desc')->get();
        $datas = [];
        
        foreach($address as $key => $item) {
            $datas[$key]['id'] = $item->id; 
            $datas[$key]['name'] = $item->name; 
            $datas[$key]['phone'] = $item->phone; 
            $datas[$key]['active'] = $item->active; 
            $province = Province::find($item->province_id);
            $districts = District::find($item->districts_id);
            $wards = Ward::find($item->wards_id);
            $datas[$key]['address_user'] = $item->specific_address.' - '.$wards->name.' - '.$districts->name.' - '.$province->name; 
            $datas[$key]['datas'] = $item;
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'datas' => $datas
        ]);
    }
}
