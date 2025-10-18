<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\Property;
use App\Models\Prop\PropImage;
use App\Models\Prop\Request as PropRequest;
use App\Models\Prop\SavedProp;
use Illuminate\Support\Facades\Auth;

class PropertiesController extends Controller
{
    public function index(){
        $props = Property::orderBy('created_at', 'desc')->take(9)->get();
        return view('home', compact('props'));
    }

    public function single($id) {
        $singleProp = Property::findOrFail($id);
        $propImages = PropImage::where('prop_id', $id)->get(); 

        // Related props
        $relatedProps = Property::where('home_type', $singleProp->home_type)->where('id', '!=', $id)->take(3)->orderBy('created_at', 'desc')->get();

        // validate form requests

        $validateFormCount = PropRequest::where('prop_id', $id)->where('user_id', Auth::id()?? 0)->count();
        
        // Validate saving props
        $validateSaveCount = SavedProp::where('prop_id', $id)->where('user_id', Auth::id()?? 0)->count();
        return view('props.single', compact('singleProp', 'propImages', 'relatedProps', 'validateFormCount', 'validateSaveCount'));
    }
    public function insertRequest(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|email|max:70',
            'phone' => 'required|string|max:20',
        ]);
        PropRequest::create([
            'prop_id' =>$id,
            'agent_name' => $request->agent_name,
            'user_id' =>Auth::id() ?? 0,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        return redirect('/props/prop-details/'.$id.'')->with('success', 'Your request has been sent successfully.');
    }

    public function saveProps(Request $request, $id){
        $prop = Property::findOrFail($id);

        if(SavedProp::where('prop_id', $prop->id)->where('user_id', Auth::id())->exists()){
            return redirect()->back()->with('info', 'You have already saved this property.');
        }
        SavedProp::create([
            'prop_id' => $prop->id,
            'user_id' => Auth::id(),
            'title' => $prop->title,
            'image' => $prop->image,
            'price' => $prop->price,
            'location' => $prop->location,
        ]);

        return redirect()->back()->with('save', 'Property saved successfully.');
    }

    public function deleteProps(Request $request, $id){
        $savedProp = SavedProp::where('prop_id', $id)->where('user_id', Auth::id())->first();

        if(!$savedProp){
            return redirect()->back()->with('info', 'Saved property not found.');
        }

        $savedProp->delete();

        return redirect()->back()->with('delete', 'Property removed from saved properties.');
    }

    public function propsBuy(){
        $type = 'Buy';
        $propsBuy = Property::where('type', $type)->orderBy('created_at', 'desc')->paginate(9);
        return view('props.propsbuy', compact('propsBuy'));
    }   
  
    public function propsRent(){
        $type = 'Rent';
        $propsRent = Property::where('type', $type)->orderBy('created_at', 'desc')->paginate(9);
        return view('props.propsrent', compact('propsRent'));
    }   
}
