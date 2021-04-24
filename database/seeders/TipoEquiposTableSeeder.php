<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoEquiposTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_equipos')->delete();
        
        \DB::table('tipo_equipos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Impresora',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 18:35:39',
                'updated_at' => '2021-04-22 18:35:39',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Computadora de escritorio completa',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 18:36:16',
                'updated_at' => '2021-04-22 18:36:16',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Computadoras portátil',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 18:36:44',
                'updated_at' => '2021-04-22 18:36:44',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Monitor',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 18:37:06',
                'updated_at' => '2021-04-22 18:37:06',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'PC',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 18:37:29',
                'updated_at' => '2021-04-22 18:37:29',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'Escaner',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 18:37:44',
                'updated_at' => '2021-04-22 18:37:44',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'Accesorio',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 18:39:48',
                'updated_at' => '2021-04-22 18:39:48',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}