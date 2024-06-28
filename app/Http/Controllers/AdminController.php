<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function loginForm()
    {
        return view('login', [
            'title' => 'Welcome Admin',
            'actionUrl' => '/admin/login/action'
        ]);
    }

    public function loginAction(LoginRequest $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))) {
            return back()->withInput()->with('error', 'error');
        }

        $request->session()->regenerate();
        return redirect('/admin/');
    }

    public function studentIndex()
    {
        $data = User::where('role_id', 2)->where('status', true)->paginate(10);
        return view('admin.student.index', ['item' => $data]);
    }

    public function pendingStudent()
    {
        $data = User::where('role_id', 2)->where('status', false)->paginate(10);
        return view('admin.student.index', ['item' => $data]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
