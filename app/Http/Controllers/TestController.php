<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Role;
use App\Team;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function createContractors(Request $request)
    {
        $input = $request->all();

        $con = Contractor::create($input);

        return response()->json(['message '=> $con ],201);
    }

    public function createTeams(Request $request)
    {
        $input = $request->all();

        $team = Team::create($input);

        return response()->json(['message '=> $team ],201);
    }
    public function createRoles(Request $request)
    {
        $input = $request->all();

        $role = Role::create($input);

        return response()->json(['message '=> $role ],201);
    }
    public function allTeams()
    {

        $team = Team::all();

        return view('team', compact('team'));

        return response()->json(['message'=> $team ],200);
    }
}
