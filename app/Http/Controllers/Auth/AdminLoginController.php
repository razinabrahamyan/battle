<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        if (auth()->guard('admin')->check())
        {
            auth()->guard('admin')->logout();
        } elseif (auth()->check())
        {
            auth()->logout();
        }
        return view('auth.admins.login');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
