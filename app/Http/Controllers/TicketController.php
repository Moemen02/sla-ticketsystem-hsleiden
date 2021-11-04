<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Validator;

class TicketController extends Controller
{

    public $succesStatus = 200;

    public function createTicket(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'userID' => 'required',
                'contractID' => 'required',
                'ticket_title' => 'required',
                'description' => 'required',
                'assigned_by' => 'required',
                'assigned_for' => 'required',
                'due_to' => 'required',
            ]
        );

        if ($validator->fails()) { 
            return response()->json([
                'error'=>$validator->errors()
            ], 401);
        }

        $input = $request->all();
        $ticket = Ticket::create($input);

        return response()->json([
            'succes' => "ticket added"
        ], $this->succesStatus);
    }
}
