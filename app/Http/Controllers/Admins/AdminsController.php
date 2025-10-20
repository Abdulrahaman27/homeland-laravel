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
        Request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);
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
    
    // create home types
    public function createHomeTypes() {
        return view('admins.createhometypes');
    }

    // store home types
    public function storeHomeTypes(Request $request){
        Request()->validate([
            'home_types' => 'required|string|max:255',
        ]);
        $storeHomeTypes = HomeType::create([
            'home_types' => $request['home_types'],
        ]);

        if($storeHomeTypes){
            return redirect('/admin/all-hometypes/')->with('success', 'Home type added successfully.');
        } 
    }
   
}
