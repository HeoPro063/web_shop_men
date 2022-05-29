<?php

namespace App\Http\Controllers\Frontend;

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


    public function index() {
        return view('frontend.pages.login');
    }

    public function postLogin(Request $request) {
        $data = $request->all();
        try {
            $this->validator->with($data)->passesOrFail(BaseValidatorInterface::RULE_LOGIN);
        } catch (ValidatorException $e) {
            return redirect()->route('user.login')->withErrors($e->getMessageBag())->withInput();
        }
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], true)) {
            return redirect()->route('home')->withInput();
        }
        $request->session()->flash('login-error', __('Incorrect email or password.'));
        return redirect()->route('user.login')->withInput();
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
