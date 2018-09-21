<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Administrador
        User::create([
        	'name' =>'Administrador',
        	'email' =>'admin@ucss.pe',
        	'password' => bcrypt('123456789'),
        	'role' => 0
        ]);

        //Client
        User::create([
        	'name' =>'Cliente',
        	'email' =>'client@ucss.pe',
        	'password' => bcrypt('123456789'),
        	'role' => 2
        ]);
    }
}
