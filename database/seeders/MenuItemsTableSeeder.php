<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_id' => 1,
                'title' => 'Inicio',
                'url' => 'admin',
                'target' => '_self',
                'icon_class' => 'voyager-rum',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-13 23:10:12',
                'route' => NULL,
                'parameters' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'menu_id' => 1,
                'title' => 'Media',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 2,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-13 23:01:01',
                'route' => 'voyager.media.index',
                'parameters' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Users',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => NULL,
                'parent_id' => 12,
                'order' => 1,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-14 11:09:38',
                'route' => 'voyager.users.index',
                'parameters' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Roles',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => NULL,
                'parent_id' => 12,
                'order' => 2,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-14 11:09:38',
                'route' => 'voyager.roles.index',
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Herramientas',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tools',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-14 12:22:15',
                'route' => NULL,
                'parameters' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Menu Builder',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 1,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-13 23:00:40',
                'route' => 'voyager.menus.index',
                'parameters' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Database',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 3,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-13 23:01:01',
                'route' => 'voyager.database.index',
                'parameters' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'menu_id' => 1,
                'title' => 'Compass',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-compass',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 4,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-13 23:01:01',
                'route' => 'voyager.compass.index',
                'parameters' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'BREAD',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bread',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 5,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-13 23:01:01',
                'route' => 'voyager.bread.index',
                'parameters' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Configuración',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-settings',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 6,
                'created_at' => '2021-04-14 02:52:59',
                'updated_at' => '2021-04-14 12:22:15',
                'route' => 'voyager.settings.index',
                'parameters' => 'null',
            ),
            10 => 
            array (
                'id' => 12,
                'menu_id' => 1,
                'title' => 'Seguridad',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2021-04-13 23:00:34',
                'updated_at' => '2021-04-13 23:01:05',
                'route' => NULL,
                'parameters' => '',
            ),
            11 => 
            array (
                'id' => 13,
                'menu_id' => 1,
                'title' => 'Administración',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-browser',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2021-04-14 12:07:31',
                'updated_at' => '2021-04-14 12:22:10',
                'route' => NULL,
                'parameters' => '',
            ),
            12 => 
            array (
                'id' => 14,
                'menu_id' => 1,
                'title' => 'Parámetros',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-params',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 4,
                'created_at' => '2021-04-14 12:07:41',
                'updated_at' => '2021-04-14 12:22:10',
                'route' => NULL,
                'parameters' => '',
            ),
            13 => 
            array (
                'id' => 16,
                'menu_id' => 1,
                'title' => 'Cargos',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-certificate',
                'color' => NULL,
                'parent_id' => 14,
                'order' => 1,
                'created_at' => '2021-04-14 12:11:20',
                'updated_at' => '2021-04-14 12:21:10',
                'route' => 'voyager.cargos.index',
                'parameters' => NULL,
            ),
            14 => 
            array (
                'id' => 17,
                'menu_id' => 1,
                'title' => 'Clientes',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => NULL,
                'parent_id' => 13,
                'order' => 1,
                'created_at' => '2021-04-14 12:13:03',
                'updated_at' => '2021-04-14 12:21:19',
                'route' => 'voyager.clientes.index',
                'parameters' => NULL,
            ),
            15 => 
            array (
                'id' => 18,
                'menu_id' => 1,
                'title' => 'Empleados',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => NULL,
                'parent_id' => 13,
                'order' => 2,
                'created_at' => '2021-04-14 12:16:01',
                'updated_at' => '2021-04-14 12:21:24',
                'route' => 'voyager.empleados.index',
                'parameters' => NULL,
            ),
            16 => 
            array (
                'id' => 19,
                'menu_id' => 1,
                'title' => 'Estados de Servicios',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tag',
                'color' => NULL,
                'parent_id' => 14,
                'order' => 2,
                'created_at' => '2021-04-14 12:20:25',
                'updated_at' => '2021-04-14 12:21:17',
                'route' => 'voyager.servicios-estados.index',
                'parameters' => NULL,
            ),
        ));
        
        
    }
}