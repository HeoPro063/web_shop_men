<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        $user = new User();
        $user->role_id = 2;
        $user->name = "User Đẹp Trai";
        $user->email = "hao@gmail.com";
        $user->password = Hash::make('123123');
        $user->save();

        //    $user = new Role();
        // $user->name = 'Customer';
        // $user->status = 2;
        // $user->save();
        // \App\Models\User::factory(10)->create();
    }
}
