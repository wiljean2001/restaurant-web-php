<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
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


    public function update(Request $request, $id)
    {
        return view('admin.roles.update');
    }

    public function destroy($id)
    {
        //
    }
}
