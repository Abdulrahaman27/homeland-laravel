<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Prop\Property;
use Illuminate\Http\Request;
use App\Models\Prop\Request as Requests;
use Illuminate\Container\Attributes\Auth;
use App\Models\Prop\SavedProp;

class UsersController extends Controller
{
    public function allRequests()
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }
        $Requests = Requests::where('user_id', auth()->id())->get();
        return view('users.displayrequests', compact('Requests'));
    }

    public function savedProperties(){
         if (!auth()->user()) {
            return redirect()->route('login');
        }else{
        $savedProps = SavedProp::with('property')
        ->where('user_id', auth()->id())
        ->get();
        return view('users.savedproperties', compact('savedProps'));
        }
    }
} 
