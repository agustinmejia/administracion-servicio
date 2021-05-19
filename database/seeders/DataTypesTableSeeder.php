<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-20 23:02:40',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-14 02:52:59',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'policy_name' => NULL,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-14 02:52:59',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'cargos',
                'slug' => 'cargos',
                'display_name_singular' => 'Cargo',
                'display_name_plural' => 'Cargos',
                'icon' => 'voyager-certificate',
                'model_name' => 'App\\Models\\Cargo',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-04-14 12:11:20',
                'updated_at' => '2021-04-14 12:14:33',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'clientes',
                'slug' => 'clientes',
                'display_name_singular' => 'Cliente',
                'display_name_plural' => 'Clientes',
                'icon' => 'voyager-people',
                'model_name' => 'App\\Models\\Cliente',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-04-14 12:13:03',
                'updated_at' => '2021-04-20 23:04:52',
            ),
            5 => 
            array (
                'id' => 8,
                'name' => 'empleados',
                'slug' => 'empleados',
                'display_name_singular' => 'Empleado',
                'display_name_plural' => 'Empleados',
                'icon' => 'voyager-person',
                'model_name' => 'App\\Models\\Empleado',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-04-14 12:16:01',
                'updated_at' => '2021-04-14 12:17:15',
            ),
            6 => 
            array (
                'id' => 9,
                'name' => 'servicios_estados',
                'slug' => 'servicios-estados',
                'display_name_singular' => 'Estado de Servicios',
                'display_name_plural' => 'Estados de Servicios',
                'icon' => 'voyager-tag',
                'model_name' => 'App\\Models\\ServiciosEstado',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":"orden","order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-04-14 12:20:25',
                'updated_at' => '2021-04-14 12:28:02',
            ),
            7 => 
            array (
                'id' => 10,
                'name' => 'tipo_equipos',
                'slug' => 'tipo-equipos',
                'display_name_singular' => 'Tipo de Equipo',
                'display_name_plural' => 'Tipos de Equipos',
                'icon' => 'voyager-book',
                'model_name' => 'App\\Models\\TipoEquipo',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2021-04-22 17:41:28',
                'updated_at' => '2021-04-22 17:41:28',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'productos',
                'slug' => 'productos',
                'display_name_singular' => 'Producto',
                'display_name_plural' => 'Productos',
                'icon' => 'voyager-gift',
                'model_name' => 'App\\Models\\Producto',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-05-11 15:57:45',
                'updated_at' => '2021-05-11 18:16:49',
            ),
            9 => 
            array (
                'id' => 13,
                'name' => 'registros_cajas',
                'slug' => 'registros-cajas',
                'display_name_singular' => 'Registro de Caja',
                'display_name_plural' => 'Registros de Caja',
                'icon' => 'voyager-dollar',
                'model_name' => 'App\\Models\\RegistrosCaja',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":"id","order_display_column":"id","order_direction":"desc","default_search_key":"tipo","scope":null}',
                'created_at' => '2021-05-19 14:41:11',
                'updated_at' => '2021-05-19 14:43:37',
            ),
        ));
        
        
    }
}