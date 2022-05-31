<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::guard('admins')->user()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    /**
     * Admin Login
     * 
     */
    public function login(AdminLoginRequest $request)
    {
        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password])) {
 
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Please check your credentials!!!')->withInput($request->only('email', 'remember'));
    }

    /**
     * On Sucess login it shows dashbaord to admin users
     * 
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * On Sucess login it shows dashbaord to admin users
     * 
     */
    public function logout()
    {
        \Auth::guard('admins')->logout();

        return redirect('admin/login');
    }
}
