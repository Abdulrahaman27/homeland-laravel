<?php

namespace App\Http\Controllers\Admins;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class AdminsController extends Controller
{
    public function viewLogin() {
        return view('admins.login');
    }

    public function checkLogin(Request $request){
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('admins.dashboard');
        }

        return redirect()->back()->withErrors(['Invalid credentials provided.']);
    }

    public function index() {
        return view('admins.index');
    }
}
