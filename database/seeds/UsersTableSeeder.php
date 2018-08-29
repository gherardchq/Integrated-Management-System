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
    	//Admin
        User::create([
        	'name' =>'Gherard',
        	'email' =>'2014100007@ucss.pe',
        	'password' => bcrypt('72930812'),
        	'role' => 0
        ]);

        //Support
        User::create([
        	'name' =>'Joel',
        	'email' =>'jlopez@ucss.edu.pe',
        	'password' => bcrypt('12345678'),
        	'role' => 1
        ]);

        //Client
        User::create([
        	'name' =>'Raul',
        	'email' =>'rbizarro@ucss.edu.pe',
        	'password' => bcrypt('12345678'),
        	'role' => 2
        ]);
    }
}
