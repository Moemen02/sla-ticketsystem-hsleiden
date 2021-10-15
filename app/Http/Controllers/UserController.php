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
}
