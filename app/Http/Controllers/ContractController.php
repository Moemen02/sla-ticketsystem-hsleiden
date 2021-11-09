<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ContractController extends Controller
{
    public function makeContract(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'contract_name' => 'required',
                'companyID' => 'required|numeric',
                'ends_at' => 'required|date',
                'times_extended' => 'required|numeric',
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
