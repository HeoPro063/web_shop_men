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
        // $this->call(CategorySeeder::class);
        // $this->call(ColorSeeder::class);
        // $this->call(SizeSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(ProductColorSeeder::class);
        // $this->call(ProductSizeSeeder::class);
        // $this->call(ImageProductSeeder::class);
        // $user = new User();
        // $user->role_id = 2;
     
            // $user = new Role();
            // $user->name = 'Admin';
            // $user->status = 1;
            // $user->save();
            // $user = new Role();
            // $user->name = 'Customer';
            // $user->status = 1;
            // $user->save();
        
        $user = new User();
        $user->name = "User Đẹp Trai";
        $user->role_id = 2;
        $user->email = "hao@gmail.com";
        $user->password = Hash::make('123123');
        $user->save();
        $user = new User();
        $user->role_id = 1;
        $user->name = "Admin Đẹp Trai";
        $user->email = "admin@admin.com";
        $user->password = Hash::make('123123');
        $user->save();


        // \App\Models\User::factory(10)->create();
    }
}
