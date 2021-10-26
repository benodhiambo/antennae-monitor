<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function showRolesList()
    {
        $roles = Role::all();
        return view('auth.rolelist', compact('roles'));
    }

    public function showAddRoleForm()
    {
        return view('auth.register_role');
    }

    public function addRole(Request $request)
    {
        $role = new Role();
        if ($request->isMethod('post')) {
            if ($request->filled('role_name')) {
                $request->validate([
                    'role_name' => [
                        'required',
                        'string',
                        'unique:roles',
                        'max:255',
                    ],
                ]);
                $role->role_name = $request->input('role_name');
            }
            $role->save();
        }
        return redirect('/roles');
    }

    public function updateRole(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        if ($request->isMethod('post')) {
            if ($request->filled('role_name')) {
                $request->validate([
                    'role_name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('roles')->ignore($role->id),
                    ],
                ]);
                $role->role_name = $request->input('role_name');
            }
            $role->save();
        }
        return redirect('/roles');
    }

    public function showRoleUpdateForm($role_id)
    {
        $roleData = DB::table('roles')->where('id', '=', $role_id)->get();
        return view('auth.update_role', compact('roleData'));
    }
}
