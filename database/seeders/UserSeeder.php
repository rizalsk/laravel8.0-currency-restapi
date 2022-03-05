<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!User::where(['email' => 'admin@mail.com'])->first()){
            User::create([
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'password' => Hash::make('password'),
            ]);
        }
    }
}
