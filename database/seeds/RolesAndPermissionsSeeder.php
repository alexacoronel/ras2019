<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
	{
    	// Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'Add sensor']);
        Permission::create(['name' => 'Delete sensor']);
        Permission::create(['name' => 'Add parameter']);
        Permission::create(['name' => 'Delete parameter']);
        Permission::create(['name' => 'Administer roles & permissions']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'Manager']);
        $role->givePermissionTo('Add sensor');
        $role->givePermissionTo('Delete sensor');
        $role->givePermissionTo('Add parameter');
        $role->givePermissionTo('Delete parameter');

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo('Administer roles & permissions');

    }
}
