<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    use AuthenticatesUsers;

    public function deactivate(Request $request){
        $user = auth()->user();
        $user->status = 'deactivated';
        $user->save();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('guest.home')->with('success','account deactivated');

    }

    public function delete(Request $request){
        $user = auth()->user();
        $user->status = 'deleted';
        $user->save();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('guest.home')->with('success','account deleted');
    }

    public function account(){
        return view('user_dashboard.account_info');
    }

    public function activate(){
        $user = auth()->user();
        $user->status = 'active';
        $user->save();
        return redirect()->route('user.home')->with('success','account activated');
    }

}
