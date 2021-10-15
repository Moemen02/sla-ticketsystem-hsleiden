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
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $userToken = $user->createToken($request->email)->plainTextToken;
    
        return response()->json([
            'userToken' => $userToken
        ], $this->succesStatus);
    }

    public function getCurrentUser(Request $request){
        $currentUser = $request->user();
        return response()->json([
            'currentUser' => $currentUser
        ], $this->succesStatus);
    }
}
