<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    User::create([
        'username' => 'superadmin',
        'password' => Hash::make('bjb1234'),
        'phone' => '087716965894',
        'email' => 'suadmkinaara@gmail.com',
        'role' => 'super_admin'
    ]);
    
    User::create([
        'username' => 'admin',
        'password' => Hash::make('admin123'),
        'phone' => '08990041550',
        'email' => 'adm1kinaara@gmail.com',
        'role' => 'admin'
    ]);
}
}
