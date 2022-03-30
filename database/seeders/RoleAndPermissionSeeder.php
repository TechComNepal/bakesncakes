<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions
        Permission::create(['name'=>'add user']);
        Permission::create(['name'=>'view user']);
        Permission::create(['name'=>'edit user']);
        Permission::create(['name'=>'delete user']);

        Permission::create(['name'=>'add category']);
        Permission::create(['name'=>'view category']);
        Permission::create(['name'=>'edit category']);
        Permission::create(['name'=>'delete category']);

        Permission::create(['name'=>'add brand']);
        Permission::create(['name'=>'view brand']);
        Permission::create(['name'=>'edit brand']);
        Permission::create(['name'=>'delete brand']);

        Permission::create(['name'=>'add product']);
        Permission::create(['name'=>'view product']);
        Permission::create(['name'=>'edit product']);
        Permission::create(['name'=>'delete product']);

        Permission::create(['name'=>'add blog']);
        Permission::create(['name'=>'view blog']);
        Permission::create(['name'=>'edit blog']);
        Permission::create(['name'=>'delete blog']);

        //create roles and give created permissions to each role

        $role= Role::create(['name'=>'superadmin']);
        $role->givePermissionTo(Permission::all());

        $roleAdmin= Role::create(['name'=>'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleEmployee = Role::create(['name' => 'employee']);

        $roleUser = Role::create(['name' => 'user']);

    }
}
