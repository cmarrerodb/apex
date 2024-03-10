<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // User::create(['name' => 'admin','email' => 'admin@themesbrand.com','password' => Hash::make('123456'),'email_verified_at'=>'2022-01-02 17:04:58','avatar' => 'avatar-1.jpg','created_at' => now(),]);

        $user = User::where('email', 'admin@themesbrand.com')->first();
        $user->assignRole(['SuperUsuario']);       


    }
}
