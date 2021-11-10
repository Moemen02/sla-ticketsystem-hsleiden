<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ContractController extends Controller
{
    public $succesStatus = 200;

    public function getContracts(Request $request){
        $contracts = Contract::all();
        return $contracts;
    }

    public function makeContract(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'contract_name' => 'required|unique:contracts',
                'active' => 'required|boolean',
                'companyID' => 'required|numeric',
                'starting_at' => 'required|date',
                'ends_at' => 'required|date',
                'times_extended' => '',
            ]
        );

        if ($validator->fails()) { 
            return response()->json([
                'error'=>$validator->errors()
            ], 401);
        }

        $input = $request->all();
        $contract = Contract::create($input);

        return response()->json([
            'succes' => "contract added"
        ], $this->succesStatus);
    }
}
