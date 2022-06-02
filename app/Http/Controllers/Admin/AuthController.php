<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Validators\AuthValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class AuthController extends Controller
{
    //

    protected $validator;
    public function __construct(AuthValidator $validator)
    {
        $this->validator = $validator;
    }


    public function logIn(Request $request) {
        $data = $request->all();

        try {
            $this->validator->with($data)->passesOrFail(BaseValidatorInterface::RULE_LOGIN);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 403,
                'message' => 'Bad request',
                'datas' => $e->getMessageBag()
            ]);
        }
        $remember = isset($data['remember']) ? true : false;

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
            if(Auth::user()->role_id != 2) {
                return response()->json([
                    'status' => 200,
                    'message' => 'successfully',
                    'datas' => Auth::user()
                ]);
            }
            Auth()->logout();
        } 
        return response()->json([
            'status' => 403,
            'message' => 'Not main login information',
        ]);
    }

    public function logout() {
        Auth()->logout();
        return redirect()->route('admin.index');
    }
}
