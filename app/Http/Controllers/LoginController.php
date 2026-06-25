<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('index');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('users')
            ->where('email', $request->email)
            ->first();

        if($user && Hash::check($request->password, $user->password)) {
            Session::put('user_id', $user->id);
            Session::put('user_email', $user->email);
            Session::put('name', $user->first_name);

            // $userName = Session::get('name');
            return redirect('/admin/index');
        }else {
            return back()->withErrors(['email' => 'Invalid Credentials']);
        }
 
    }

    public function logout() {
        Session::flush();
    Session::invalidate();
    Session::regenerateToken();
        return redirect('/');
    }
}
