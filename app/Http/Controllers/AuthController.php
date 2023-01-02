<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $validator = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            if (Auth::attempt($validator)) {
                $request->session()->regenerate();
                return redirect('/dashboard')->with(['success' => 'Welcome back to you dashboard!']);
            } else {
                return redirect()->back()->with('error', 'your Email or Password error!');
            }
        } catch (QueryException $th) {
            $th->errorInfo;
            return redirect()->back();
        }
    }
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerate();
            return redirect('/login')->with(['info' => 'Thanks you, see you next time!']);
        } catch (QueryException $th) {
            $th->errorInfo;
            return redirect()->back();
        }
    }
}
