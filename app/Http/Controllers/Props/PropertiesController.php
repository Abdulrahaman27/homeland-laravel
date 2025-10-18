<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\Property;
use App\Models\Prop\PropImage;
use App\Models\Prop\Request as PropRequest;
use Illuminate\Support\Facades\Auth;

class PropertiesController extends Controller
{
    public function index(){
        $props = Property::select()->take(9)->orderBy('created_at', 'desc')->get();
        return view('home', compact('props'));
    }

    public function single($id) {
        $singleProp = Property::findOrFail($id);
        $propImages = PropImage::where('prop_id', $id)->get(); 

        // Related props
        $relatedProps = Property::where('home_type', $singleProp->home_type)->where('id', '!=', $id)->take(3)->orderBy('created_at', 'desc')->get();
        return view('props.single', compact('singleProp', 'propImages', 'relatedProps'));
    }
    public function insertRequest(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        PropRequest::create([
            'prop_id' => $request->prop_id,
            'agent_name' => $request->agent_name,
            'user_id' =>Auth::id() ?? 0,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->back()->with('success', 'Your request has been sent successfully.');
    }
}
