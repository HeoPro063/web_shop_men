<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use File;
use Hash;

class UserController extends Controller
{
    //

    public function myProfile() {
        $user = Auth::check() ? Auth::user() : null;
        return view('frontend.pages.user.layout', compact('user'));
    }

    public function postAvatar(Request $request) {
        $user = Auth::check() ? Auth::user() : null;
        try {
            DB::beginTransaction();
            $user = User::find($user->id);
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $file_ext = $file->getClientOriginalExtension();
                if(!in_array($file_ext, EXPENSIONS)) {
                    return response()->json([
                        'status' => 403,
                        'message' => 'Image not found',
                    ]);
                }
                $filename =   time().rand(1,100). '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/avatars'), $filename);
                if($user->avatar) {
                    $path_image_old = 'uploads/avatars/'. $user->avatar;
                    if(File::exists($path_image_old)){
                        File::delete($path_image_old);
                    }
                }
                $user->avatar = $filename;
                $user->save();
            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'datas' => $user
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getDataMyprofile(){
        $user = Auth::check() ? Auth::user() : null;
        $dataUser = User::find($user->id);
        $datas = [];
        $datas['id'] = $dataUser->id;
        $datas['username'] = $dataUser->name;
        $datas['email'] = $dataUser->email;
        $datas['number'] = $dataUser->number_phone;
        $datas['gender'] = $dataUser->gender;
        $datas['birthday'] = $dataUser->birthday;
        $datas['avatar'] = $dataUser->avatar;
        if($dataUser->birthday) {
            $arrayBirthday = explode('-',$dataUser->birthday);
            $datas['day'] = $arrayBirthday[0];
            $datas['month'] = $arrayBirthday[1];
            $datas['year'] = $arrayBirthday[2];
        }
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'datas' => $datas
        ]);
    }

    public function saveDataMyprofile(Request $request) {
        $datas = $request->all();
        $datas['birthday'] = $datas['birthday']['day'].'-'.$datas['birthday']['month'].'-'.$datas['birthday']['year'];
        $user = User::where('id', $datas['id'])
        ->update($datas);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'datas' => $user
        ]);
    }

    public function saveChangePassword(Request $request) {
        $data = $request->all();
        $user = User::find(Auth()->user()->id);
        if (Hash::check($data['password_old'], $user->password)) {
            $user->password = Hash::make($data['password_new']);
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => '',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Old password is incorrect',
                'data' => '',
            ]);
        }
    }

}
