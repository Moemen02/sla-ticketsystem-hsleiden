<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public $succesStatus = 200;

    public function getCurrentUser(Request $request){
        $currentUser = $request->user();
        return response()->json([
            'currentUser' => $currentUser
        ], $this->succesStatus);
    }

    public function getAllUsers(Request $request){
        $users = User::where('role', 'user')->get();
        return $users;
    }

    public function getAllAdmins(Request $request){
        $admins = User::where('role', 'admin')->get();
        return $admins;
    }
}
