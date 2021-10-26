<?php

namespace App\Http\Controllers;

use App\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContractorController extends Controller
{
    public function showContractorsList()
    {
        $cons = Contractor::all();
        return view('auth.contractorlist', compact('cons'));
    }

    public function showAddContractorForm()
    {
        return view('auth.register_contractor');
    }

    public function addContractor(Request $request)
    {
        $con = new Contractor();
        if ($request->isMethod('post')) {
            if ($request->filled('contractor_name')) {
                $request->validate([
                    'contractor_name' => [
                        'required',
                        'string',
                        'max:255',
                    ],
                ]);
                $con->contractor_name = $request->input('contractor_name');
            }
            if ($request->filled('status')) {
                $request->validate([
                    'status' => [
                        'required'
                    ],
                ]);
                $con->status = $request->input('status');
            }
            $con->save();
        }
        return redirect('/contractors');
    }

    public function updateContractor(Request $request)
    {
        $con = Contractor::find($request->input('con_id'));
        if ($request->isMethod('post')) {
            if ($request->filled('contractor_name')) {
                $request->validate([
                    'contractor_name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('contractors', 'contractor_name')->ignore($con->id)
                    ],
                ]);
                $con->contractor_name = $request->input('contractor_name');
            }
            if ($request->filled('status')) {
                $request->validate([
                    'status' => [
                        'required',
                    ],
                ]);
                $con->status = $request->input('status');
            }
            $con->save();
        }
        return redirect('/contractors');
    }

    public function showConUpdateForm($con_id)
    {
        $conData = DB::table('contractors')->where('id', '=', $con_id)->get();
        return view('auth.update_contractor', compact('conData'));
    }
}
