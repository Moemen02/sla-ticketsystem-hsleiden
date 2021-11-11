<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CompanyController extends Controller
{
    public $succesStatus = 200;

    public function getCompanies(Request $request){
        $companies = Company::all();
        return $companies;
    }

    public function getUserCompany($id){
        $company = Company::where('id', $id)->get();
        return $company;
    }

    public function createCompany(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'company_name' => 'required|unique:companies',
                'total_employees' => '',
                'kvk' => 'required|numeric|unique:companies',
            ]
        );

        if ($validator->fails()) { 
            return response()->json([
                'error'=>$validator->errors()
            ], 401);
        }

        $input = $request->all();
        $company = Company::create($input);

        return response()->json([
            'succes' => "company added"
        ], $this->succesStatus);
    }

    public function updateTotalEmployees($companyID, $totalEmployees){
        $company = Company::where('id', $companyID)->update(['total_employees' => $totalEmployees]);
        return $this->succesStatus;
    }
}
