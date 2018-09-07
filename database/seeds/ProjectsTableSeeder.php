<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
        		'name' => 'Ciclo 2018 - I',
        		'description' => 'El Ciclo 2018 - I está conformado entre los meses de Enero y Julio'
        ]);

        Project::create([
        		'name' => 'Ciclo 2018 - II',
        		'description' => 'El Ciclo 2018 - II está conformado entre los meses de Agosto y Diciembre'
        ]);
    }
}
