<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\Http\Controllers\CompanyController;

class UserController extends Controller
{
    public $succesStatus = 200;
    protected $companyController;

    public function __construct(CompanyController $companyController){
        $this->companyController = $companyController;
    }

    public function registerUser(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'username' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'password' => 'required',
                'phone_number' => 'required',
                'role' => '',
                'companyID' => 'required',
                'companyRole' => 'required',
            ]
        );

        if ($validator->fails()) { 
            return response()->json([
                'error'=>$validator->errors()
            ], 401);
        }
        
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $newUser = User::create($input);
        
        $companyID = $input['companyID'];
        $totalEmployees = User::where('companyID', $companyID)->get();
        $newTotalEmployees = $this->companyController->updateTotalEmployees($companyID, count($totalEmployees));

        return response()->json([
            'succes' => "user added",
        ], $this->succesStatus);
    }

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
