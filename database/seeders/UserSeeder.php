<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
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
            'name' => 'Juan',
            'last_name' => 'Urdaneta',
            'email' => 'email1@gmail.com',
            'job' => 'full-stack developer',
            'birthday' => date('Y-m-d'),
            'estatus' => 1,
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Carlos',
            'last_name' => 'Lópes',
            'email' => 'email2@gmail.com',
            'job' => 'full-stack developer',
            'birthday' => date('Y-m-d'),
            'estatus' => 1,
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Sara',
            'last_name' => 'Carmona',
            'email' => 'email3@gmail.com',
            'job' => 'full-stack developer',
            'birthday' => date('Y-m-d'),
            'estatus' => 1,
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Alejandra',
            'last_name' => 'Medina',
            'email' => 'email4@gmail.com',
            'job' => 'full-stack developer',
            'birthday' => date('Y-m-d'),
            'estatus' => 1,
            'password' => bcrypt('1234'),
        ]);
        
    }
}
