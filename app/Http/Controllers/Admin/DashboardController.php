<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    //

    public function index() {
        if(Auth::check() && Auth::user()->role_id != 2) {
            return $this->home();
        }else {
            if(Auth::check()) {
                Auth::logout();
            }
            return view('admin.pages.user.index');
        }
    }

    public function home() {
        return view('admin.pages.dashboard.home');
    }
}
