<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class registrationController extends Controller
{
    public function store(Request $request)
    {
        $hashPass = $request->password;

        $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|string|max:100',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8'
        ]);

        $insert = DB::table('users')->insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($hashPass),
            'created_at' => now(),
        ]);
        
        if($insert) {
            return redirect('/')->with('success', 'User registered successfully');
        } else {
            return redirect('/register')->withErrors(['msg' => 'Something went wrong please try again']);
        }
        
    }
}
