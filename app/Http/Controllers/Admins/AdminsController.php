<?php

namespace App\Http\Controllers\Admins;
use App\Models\Admin\Admin;
use App\Models\Prop\Property;
use App\Models\Prop\HomeType;
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
        $adminsCount = Admin::select()->count();
        $propsCount = Property::select()->count();
        $hometypesCount = HomeType::select()->count();
        return view('admins.index', compact('adminsCount', 'propsCount', 'hometypesCount'));
    }
}
