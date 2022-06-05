<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Validators\AuthValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Models\User;
use Validator;
use App\VerifyEmail\VerifyEmail;
use App\Jobs\MailRegisterUserJob;

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
            return redirect()->route('login')->withErrors($e->getMessageBag())->withInput();
        }
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], true)) {
            return redirect()->route('home')->withInput();
        }
        $request->session()->flash('login-error', __('Incorrect email or password.'));
        return redirect()->route('login')->withInput();
    }

    public function register(){
        return view('frontend.pages.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function postRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Lỗi nhập email'
            ]); 
        }

        $user = User::where('email', $request->email)->where('token', 0)->where('status', 1)->where('status', 2)->first();
        if ($user) {
            return response()->json([
                'status' => 400,
                'message' => 'Email đã được thiết lập, vui lòng nhập email khác',
            ]); 
        }
        $user2 = User::where('email', $request->email)->where('token', 0)->where('status', 0)->first();
        if ($user2) {
            return response()->json([
                'status' => 400,
                'message' => 'Tài khoản của bạn đã bị khóa',
            ]); 
        }
        return response()->json([
            'status' => 200,
            'message' => 'ok',
            'datas' => $request->email
        ]); 
    }

    public function confirm(Request $request) {
        $email =  $request->get('email');
        if($email) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
            if (!$validator->fails()) {
                return view('frontend.pages.confirm', compact('email'));
            }
        }
        return 'error';
    }

    public function checkEmail(Request $request ) {
        $mail = new VerifyEmail();
        $user = User::where('email', $request->email)->where('role_id', 2)->where('token','<>', 0)->where('status', 0)->first();
        if($user) {
            MailRegisterUserJob::dispatch($user);
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]); 
        }else{
            if($mail->check($request->email)){ 
                $user =  new User;
                $user->role_id = 2;
                $user->email = $request->email;
                $user->token = rand(1000, 9999);
                $user->email_verified_at = now();
                $user->status = 1;
                $user->active = 0;
                $user->created_at = now();
                $user->updated_at = now();
                $user->save();
                MailRegisterUserJob::dispatch($user);
                return response()->json([
                    'status' => 200,
                    'message' => 'success'
                ]); 
            }
        }
        return response()->json([
            'status' => 400,
            'message' => 'Email không tồn tại'
        ]); 
    }

    public function checkToken(Request $request) {
        $email = $request->email;
        $token = $request->token;
        if($email && $token) {
            $user = User::where('email', $email)->where('token', $token)->first();
            if($user) {
                $user->token =  0;
                $user->status = 1;
                $user->active = 1;
                $user->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'datas' => $user
                ]);
            }
        }
        return response()->json([
            'status' => 400,
            'message' => 'error',
            'datas' => 'Mã token không chích xác'
        ]);
    }

    public function password(Request $request) {
        $email =  $request->get('email');
        if($email) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
            if (!$validator->fails()) {
                return view('frontend.pages.password', compact('email'));
            }
        }
    }

    public function checkAccount(Request $request) {
        $email = $request->get('email');
        $user  = User::where('email', $email)->first();
        if($user) {
            if($user->active != 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                ]);
            }
        }
        return response()->json([
            'status' => 400,
            'message' => 'success',
        ]);
    }
    
    public function checkPassword(Request $request) {
        $email = $request->get('email');
        $user  = User::where('email', $email)->first();
        if($user) {
            if($user->active == 1) {
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                ]);
            }
            return response()->json([
                'status' => 201,
                'message' => 'success',
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => 'error',
        ]);
    }
}
