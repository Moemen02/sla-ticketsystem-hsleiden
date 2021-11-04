<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CompanyController extends Controller
{
    public $succesStatus = 200;

    public function createCompany(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'company_name' => 'required',
                'total_employees' => '',
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
