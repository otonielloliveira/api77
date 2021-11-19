<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        //  $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if (Hash::check($request->input('password'), $user->password)) {

            $apikey = base64_encode(Str::random(40));
            
            User::where('email', $request->input('email'))
            ->update(['api_key' => "$apikey"]);

            return response()->json(['success' => true, 'api_key' => $apikey]);
        } else {
            return response()->json(['success' => false], 401);
        }
    }


    public function me(){
    
        $user = Auth::user();

        return response()->json(compact('user'));

    }
}
