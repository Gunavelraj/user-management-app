<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email','gunavelral23@gmail.com')->first();
        if(!$user){
            DB::table("users")->insert([
                'first_name' => 'Guna',
                'last_name' => 'Velraj',
                'role' => 'admin',
                'email' => 'gunavelral23@gmail.com',
                'latitude' => 12.5025,
                'longitude' => 79.6027,
                'date_of_birth' => '1999-12-23',
                'timezone' => 'UTS',
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
