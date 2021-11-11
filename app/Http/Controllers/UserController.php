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
                'username' => 'required|unique:users',
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'phone_number' => 'required|numeric',
                'role' => '',
                'companyID' => 'required|numeric',
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

    public function updateUser(Request $request, User $user){
        $data = $request->validate([
            'username' => '',
            'firstname' => '',
            'lastname' => '',
            'email' => '',
            'password' => '',
            'phone_number' => '',
            'role' => '',
            'companyID' => '',
            'companyRole' => '',
        ]);

        $input = $request->all();
        $user->update($input);
        return $this->succesStatus;
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

    public function getEmployees($companyID){
        $employees = User::where('companyID', $companyID)->get();
        return $employees;
    }

    public function getSelectedUser($id){
        $user = User::where('id', $id)->get();
        return $user;
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->delete();
        return $this->succesStatus;
    }
}
