<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiciosEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('servicios_estados')->delete();
        
        \DB::table('servicios_estados')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Recepción',
                'descripcion' => 'Recepción de los equipos por parte de la o el recepcionista.',
                'orden' => 1,
                'created_at' => '2021-04-14 12:27:20',
                'updated_at' => '2021-04-14 12:27:20',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Diagnóstico',
                'descripcion' => 'Revisión y presentación de informe por parte de técnico responsable.',
                'orden' => 2,
                'created_at' => '2021-04-14 12:28:42',
                'updated_at' => '2021-04-14 12:28:42',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Ejecución',
                'descripcion' => 'Proceso de reparación y/o mantenimiento del o los equipos.',
                'orden' => 3,
                'created_at' => '2021-04-14 12:30:18',
                'updated_at' => '2021-04-14 12:30:25',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Entrega',
                'descripcion' => 'Entrega y cierre del servicio.',
                'orden' => 4,
                'created_at' => '2021-04-14 12:31:18',
                'updated_at' => '2021-04-14 12:31:18',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}