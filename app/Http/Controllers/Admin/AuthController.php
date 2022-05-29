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
        return $request->all();
        // try {
        //     $this->validator->with($request->all())->passesOrFail(BaseValidatorInterface::RULE_LOGIN);
        // } catch (ValidatorException $e) {
        //     return redirect()->route('admin.index')->withErrors($e->getMessageBag())->withInput();
        // }
        // $data = $request->all();
        // $remember = isset($data['remember']) ? true : false;

        // if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
        //     if(Auth::user()->role_id != 2) {
        //         return redirect()->route('admin.home')->withInput();
        //     }
        //     Auth()->logout();
        // } 
        // $request->session()->flash('login-error', __('Incorrect email or password.'));
        // return redirect()->route('admin.index')->withInput();
    }

    public function logout() {
        Auth()->logout();
        return redirect()->route('admin.index');
    }
}
