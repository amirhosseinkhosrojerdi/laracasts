<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Register New User
     * @method Post
     * @param Request $request
     */
    public function register(Request $request){
        // Validate Form Inputs
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);

        // Insert User Into Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'message' => "user create successfully"
        ], 201);
    }

    public function login(Request $request){
        # code...
    }

    public function logout(){
        # code...
    }
}
