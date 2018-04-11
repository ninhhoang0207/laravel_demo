<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'manage user']);
        Permission::create(['name' => 'view backend']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'curator']);
        $role->givePermissionTo(['view backend']);

        $role = Role::create(['name' => 'geneticist']);
        $role->givePermissionTo(['view backend']);

        $role = Role::create(['name' => 'customer']);

        $admin = User::create([
            'name'      =>  'Admin',
            'email'     =>  'admin@admin.com',
            'password'  =>  bcrypt('12345'),
            'is_active' =>  1,
        ]);
        $admin->assignRole('admin');

        $curator = User::create([
            'name'      =>  'Curator',
            'email'     =>  'curator@curator.com',
            'password'  =>  bcrypt('12345'),
            'is_active' =>  1,
        ]);
        $curator->assignRole('curator');

        $geneticist = User::create([
            'name'      =>  'Geneticist',
            'email'     =>  'geneticist@geneticist.com',
            'password'  =>  bcrypt('12345'),
            'is_active' =>  1,
        ]);
        $geneticist->assignRole('geneticist');

        $customer = User::create([
            'name'      =>  'Customer',
            'email'     =>  'customer@customer.com',
            'password'  =>  bcrypt('12345'),
            'is_active' =>  1,
        ]);
        $customer->assignRole('customer');
    }
}
