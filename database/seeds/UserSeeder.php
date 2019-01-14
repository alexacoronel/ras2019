<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run()
	{
    	// Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // User
        User::create(['name' => 'Admin',
                      'email'=> 'admin@default.com',
                      'password'=>bcrypt('secret')
                    ]);

    }
}
