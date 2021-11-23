<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'admin.auth', 'description' => 'Todos los permisos'])->assignRole($role1);
        // syncRoles([])   => asignar(relacionar) permisos a varios roles
    }
}
