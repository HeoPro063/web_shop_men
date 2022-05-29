<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;
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
        // $table =  new Roles;
        // $table->name = 'product management';
        // $table->save();
        $user = new User();
        $user->role_id = 2;
        $user->name = "Hào Siêu Cấp";
        $user->email = "hao@gmail.com";
        $user->password = Hash::make('123123');
        $user->save();
        // \App\Models\User::factory(10)->create();
    }
}
