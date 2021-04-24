<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CargosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cargos')->delete();
        
        \DB::table('cargos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'CEO',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 09:44:57',
                'updated_at' => '2021-04-22 17:20:45',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Gerente comercial',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 17:21:10',
                'updated_at' => '2021-04-22 17:21:10',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
            'nombre' => 'Secretaria(o)',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 17:21:48',
                'updated_at' => '2021-04-22 17:21:48',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Programador(a)',
                'descripcion' => NULL,
                'created_at' => '2021-04-22 17:22:19',
                'updated_at' => '2021-04-22 17:22:19',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}