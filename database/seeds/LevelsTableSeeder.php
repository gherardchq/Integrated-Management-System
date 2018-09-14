<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
        	'name' => 'Atención por teléfono',
        	'project_id' => 1
        ]);

        Level::create([
        	'name' => 'Envío de Técnico',
        	'project_id' => 1
        ]);

        Level::create([
        	'name' => 'Mesa de Ayuda',
        	'project_id' => 2
        ]);

        Level::create([
        	'name' => 'Consulta Especializada',
        	'project_id' => 2
        ]);
    }
}
