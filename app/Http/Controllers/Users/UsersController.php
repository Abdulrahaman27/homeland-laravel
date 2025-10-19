<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Prop\Property;
use Illuminate\Http\Request;
use App\Models\Prop\Request as Requests;
use Illuminate\Container\Attributes\Auth;

class UsersController extends Controller
{
    public function allRequests()
    {
        $Requests = Requests::where('user_id', auth()->id())->get();
        return view('users.displayrequests', compact('Requests'));
    }
}
