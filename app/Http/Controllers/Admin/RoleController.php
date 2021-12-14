<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::select(
            'users.id as userID',
            'users.email as userEmail',
            'users.name as userName',
            'model_has_roles.role_id as rolID',
            'roles.name as rolName'
        )
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get();
        return view('admin.roles.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('admin.roles.show');
    }

    public function edit($id)
    {
        return view('admin.roles.edit');
    }


    /**
     * 
     * UPDATE model_has_roles rm
     * INNER JOIN roles r ON rm.role_id = r.id 
     * join users u ON rm.model_id = u.id
     * set
     * rm.role_id = 2
     * where u.id = 1;
     */
    public function update(Request $request)
    {
        foreach ($request->idUser as $key => $user) {

            // Pruebas
            // printf(" user:". $user);
            // printf('Rol:'. $request->uptoRol[$key]);

            $users = Role::join('model_has_roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('users', 'model_has_roles.model_id', '=', 'users.id')
                ->where('users.id', '=', $user)
                ->update([
                    'model_has_roles.role_id' => $request->uptoRol[$key]
                ]);
        }
        return redirect()->route('role.show');
    }

    public function destroy($id)
    {
        //
    }
}
