<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public $succesStatus = 200;

    public function createTicket(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'userID' => 'required|numeric',
                'companyID' => 'required|numeric',
                'ticket_title' => 'required',
                'description' => 'required',
                'assigned_by' => 'required',
                'assigned_for' => 'required',
                // 'due_to' => '',
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

    public function getTickets(Request $request){
        $tickets = Ticket::all();
        return $tickets;
    }

    public function getUserTickets($userID){
        $userTicket = Ticket::where('userID', $userID)->get();

        return response()->json([
            'tickets' => $userTicket
        ]);
    }

    public function getCompanyTickets($companyID){
        $tickets = Ticket::where('companyID', $companyID)->get();
        return $tickets;
    }
}
