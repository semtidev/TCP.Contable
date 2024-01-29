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
    public function run() {
        
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Directivo']);
        $role3 = Role::create(['name' => 'Ejecutivo']);

        $permission = Permission::create(['name' => 'user.register'])->assignRole($role1);
        $permission = Permission::create(['name' => 'user.info'])->assignRole($role1);
    }
}
