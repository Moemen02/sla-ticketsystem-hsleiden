<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $succesStatus = 200;

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $userToken = $user->createToken($request->email)->plainTextToken;
    
        return response()->json([
            'token' => $userToken
        ], $this->succesStatus);
        // return $user->createToken($request->email)->plainTextToken;
        // return $user;
    }

    public function getCurrentUser(Request $request){
        // return $request->user();
        return response()->json([
            'user' => "user"
        ], $this->succesStatus);
    }
}
