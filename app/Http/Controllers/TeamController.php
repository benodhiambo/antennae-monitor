<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function showTeamList()
    {
        $teams = Team::all();
        $cons = Contractor::all();
        return view('auth.teamlist', compact('teams', 'cons'));
    }

    public function showAddTeamForm()
    {
        $cons = Contractor::all();
        return view('auth.register_team',compact('cons'));
    }

    public function addTeam(Request $request)
    {
        $team = new Team();
        if ($request->isMethod('post')) {
            if ($request->filled('team_name')) {
                $request->validate([
                    'team_name' => [
                        'required',
                        'string',
                        'unique:teams',
                        'max:255',
                    ],
                ]);
                $team->team_name = $request->input('team_name');
            }
            if ($request->filled('contractor_id')) {
                $request->validate([
                    'contractor_id' => [
                        'required',
                    ],
                ]);
                $team->contractor_id = $request->input('contractor_id');
            }
            $team->save();
        }
        return redirect('/teams');
    }

    public function updateTeam(Request $request)
    {
        $team = Team::find($request->input('team_id'));
        if ($request->isMethod('post')) {
            if ($request->filled('team_name')) {
                $request->validate([
                    'team_name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('teams', 'team_name')->ignore($team->id)
                    ],
                ]);
                $team->team_name = $request->input('team_name');
            }
            if ($request->filled('contractor_id')) {
                $request->validate([
                    'contractor_id' => [
                        'required',
                    ],
                ]);
                $team->contractor_id = $request->input('contractor_id');
            }
            $team->save();
        }
        return redirect('/'.$team->id.'/edit_team');
    }

    public function showTeamUpdateForm($team_id)
    {
        $teamData = DB::table('teams')->where('id', '=', $team_id)->get();
        $cons = Contractor::all();
        return view('auth.update_team', compact('teamData', 'cons'));
    }
}
