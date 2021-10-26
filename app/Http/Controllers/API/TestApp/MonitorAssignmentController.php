<?php

namespace App\Http\Controllers\API\TestApp;

use App\Contractor;
use App\Http\Controllers\Controller;

use App\MonitorAssignment;
use App\Team;
use App\User;
use Illuminate\Http\Request;

class MonitorAssignmentController extends Controller
{
    public function contractors()
    {
        $contractors = Contractor::all();
        return response()->json(['status' => 'success' , 'data' => $contractors],200);
    }

    public function teams(Request $request)
    {
        $request->validate([
            'contractor_id' => 'required',
        ]);
        $teams = Team::where('contractor_id' ,$request->get('contractor_id'))->get();
        return response()->json(['status' => 'success' , 'data' => $teams],200);


    }
    public function listInstallationEngineers(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
        ]);
        $engineers = User::where('team_id' , $request->get('team_id'))->where('role_id' ,3)->get();
        return response()->json(['status' => 'success' , 'data'=>$engineers],200);
    }

    public function assignMonitors(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'qr_number' => 'required',
        ]);

        $qr_numbers = $request->get('qr_number');

        foreach ($qr_numbers as $qr_number)
        {
            MonitorAssignment::create([
                'user_id' => $request->get('user_id'),
                'qr_number' => $qr_number,
            ]);
        }
        return response()->json(['status' => 'success' , 'data' => ['message' => 'Assignment successful!' ]]);
    } 
}