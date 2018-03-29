<?php

use Illuminate\Database\Seeder;
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
        $role_admin = DB::table('roles')->where('slug', 'admin')->first();

        if (isset($role_admin)) {
            $admin_id = DB::table('users')->insertGetId([
                'name'      =>  'Admin',
                'email'     =>  'admin@admin.com',
                'password'  =>  bcrypt('12345'),
                'is_active' =>  1,
                'role'      =>  $role_admin->id,
                'created_at'=>  Carbon::now(),
                'updated_at'=>  Carbon::now(),
            ]);

            DB::table('role_user')->insert([
                'user_id'   =>  $admin_id,
                'role_id'   =>  $role_admin->id,
            ]);
        }
    }
}
