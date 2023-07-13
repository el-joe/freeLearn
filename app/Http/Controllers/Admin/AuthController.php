<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLogin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin(Request $request)
    {
        return view('admin.login');
    }

    public function postLogin(AdminLogin $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors(['message'=> 'Invalid credentials']);
    }
}
