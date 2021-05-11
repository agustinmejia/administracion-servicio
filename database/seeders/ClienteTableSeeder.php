<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Cliente;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'nombre_completo' => 'Sin nombre',
            'nit' => '0000'
        ]);
    }
}
