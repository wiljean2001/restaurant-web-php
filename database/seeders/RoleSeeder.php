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
        // Role de admnistrador (Publicar y adminitrara roles)
        $role1 = Role::create(['name' => 'admin']);
        // Role de publisher (Solo publicar)
        $role2 = Role::create(['name' => 'publisher']);

        // asignacion de permisos para los roles
        $permission = Permission::create(['name' => 'admin.auth', 'description' => 'Todos los permisos'])
            ->assignRole([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.roles', 'description' => 'Administrar roles'])
            ->syncRoles([$role1]);

        // syncRoles([])   => asignar(relacionar) permisos a varios roles
        // 
    }
}
