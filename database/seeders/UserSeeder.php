<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
		'name'=>'Tech Master',
		'email'=>'techmaster2@gmail.com',
		'user_role'=>1,
		'email_verified_at'=>1,
		'password'=>Hash::make('admin@123'),
		]);
    }
}
