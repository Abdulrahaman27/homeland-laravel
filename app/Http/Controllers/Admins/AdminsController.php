<?php

namespace App\Http\Controllers\Admins;
use App\Models\Admin\Admin;
use App\Models\Prop\Property;
use App\Models\Prop\HomeType;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Models\Prop\Request As PropRequest;
use App\Models\Prop\PropImage;

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

    // Edit home types
    public function editHomeTypes(Request $request, $id) {
        $homeType = HomeType::find($id);
        return view('admins.edithometypes', compact('homeType'));
    }

    // Update home types
    public function updateHomeTypes(Request $request, $id){
        Request()->validate([
            'hometypes' => 'required|string|max:255',
        ]);
        $homeType = HomeType::find($id);
        $homeType->home_types = $request->input('hometypes');
        $homeType->save();

        return redirect()->route('admins.hometypes')->with('success', 'Home type updated successfully.');
    }

    // delete home types
    public function deleteHomeTypes($id){
        $homeType = HomeType::find($id);
        $homeType->delete();

        return redirect()->route('admins.hometypes')->with('success', 'Home type deleted successfully.');
    }

    // Request sent to admin
       public function requests() {
        $requests = PropRequest::all();
        return view('admins.requests', compact('requests'));
    }


    // Properties section
    public function allProperties() {
        $allProperties = Property::all();
        return view('admins.properties', compact('allProperties'));
    }

    // Create properties
    public function createProperties() {
        return view('admins.createproperties');
    }

    // store properties
public function storeProperties(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'more_info' => 'required|string',
        'price' => 'required|string',
        'price_sqft' => 'required|string',
        'bed' => 'required|integer',
        'baths' => 'required|integer',
        'sq_ft' => 'required|integer',
        'year_built' => 'required|integer',
        'location' => 'required|string|max:255',
        'home_type' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'agent_name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $destinationPath = 'assets/images/';
    $myimage = time() . '_' . $request->image->getClientOriginalName();
    $request->image->move(public_path($destinationPath), $myimage);

    $storeProperties = Property::create([
        'title' => $request->title,
        'more_info' => $request->more_info,
        'price' => $request->price,
        'price_sqft' => $request->price_sqft,
        'sq_ft' => $request->sq_ft,
        'bed' => $request->bed, // ✅ fixed name
        'baths' => $request->baths,
        'year_built' => $request->year_built,
        'type' => $request->type,
        'city' => $request->city,
        'location' => $request->location,
        'home_type' => $request->home_type,
        'agent_name' => $request->agent_name,
        'image' => $myimage,
    ]);

    return redirect('/admin/all-properties')->with('success', 'Property added successfully.');
}

    public function createGallery() {
        return view('admins.creategallery');
    }

    public function storeGallery(Request $request){
        $request->validate([
            'prop_id' => 'required|integer|exists:props,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $destinationPath = 'assets/images/';

        if($request->hasfile('images')) {
            foreach($request->file('images') as $image) {
                $myimage = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path($destinationPath), $myimage);

                // Assuming you have a Gallery model to save gallery images
                PropImage::create([
                    'prop_id' => $request->prop_id,
                    'image' => $myimage,
                ]);
            }
        }

        return redirect('/admin/create-gallery')->with('success', 'Gallery images added successfully.');
    }
}