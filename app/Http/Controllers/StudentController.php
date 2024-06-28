<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('dashboard');
    }

    public function loginForm()
    {
        return view('login', [
            'title' => 'Welcome to Elearning',
            'actionUrl' => '/login/action'
        ]);
    }

    public function loginAction(LoginRequest $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))) {
            return back()->withInput()->with('error', 'error');
        }

        $request->session()->regenerate();
        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
