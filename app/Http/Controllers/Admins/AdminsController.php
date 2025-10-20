<?php

namespace App\Http\Controllers\Admins;
use App\Models\Admin\Admin;
use App\Models\Prop\Property;
use App\Models\Prop\HomeType;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
class AdminsController extends Controller
{
    public function viewLogin() {
        return view('admins.login');
    }

    public function checkLogin(Request $request){
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

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
   
    public function allAdmins() {
        $allAdmins = Admin::all();
        return view('admins.admins', compact('allAdmins'));
    }
   
   
    public function createAdmins() {
        $allAdmins = Admin::all();
        return view('admins.createadmins');
    }

   public function storeAdmins(Request $request)
    {
        $storeAdmins = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request->password),
        ]);

        if($storeAdmins){
            return redirect('/admin/all-admins/')->with('success', 'Admin added successfully.');
        }
    }

    // Home types 
     public function allHomeTypes() {
        $allHomeTypes = HomeType::all();
        return view('admins.hometypes', compact('allHomeTypes'));
    }
   
}
