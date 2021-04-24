<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'site.title',
                'display_name' => 'Site Title',
                'value' => 'Administración',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'site.description',
                'display_name' => 'Site Description',
                'value' => 'Sistema de administración de servicios',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'site.logo',
                'display_name' => 'Site Logo',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Site',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'site.google_analytics_tracking_id',
                'display_name' => 'Google Analytics Tracking ID',
                'value' => NULL,
                'details' => '',
                'type' => 'text',
                'order' => 4,
                'group' => 'Site',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'admin.bg_image',
                'display_name' => 'Admin Background Image',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 5,
                'group' => 'Admin',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'admin.title',
                'display_name' => 'Admin Title',
                'value' => 'Administración',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'admin.description',
                'display_name' => 'Admin Description',
                'value' => 'Sistema de administración de servicios',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Admin',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'admin.loader',
                'display_name' => 'Admin Loader',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Admin',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'admin.icon_image',
                'display_name' => 'Admin Icon Image',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 4,
                'group' => 'Admin',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'admin.google_analytics_client_id',
            'display_name' => 'Google Analytics Client ID (used for admin dashboard)',
                'value' => NULL,
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'plantillas.proforma_servicios',
                'display_name' => 'Proforma de servicios',
                'value' => '<table style="width: 100%; height: 100hv; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 33.9074%;"><img src="/img/docs/logo.png" alt="" width="100" height="100" /></td>
<td style="width: 36.4909%; text-align: right;">
<h1 style="font-size: 30px;">PROFORMA</h1>
<p>Fecha: 29-04-2021</p>
</td>
</tr>
<tr>
<td style="width: 33.9074%;">
<p>&nbsp;</p>
<p><span style="font-size: 18px; font-weight: bold;">Server la Estrella</span> <br />4168207017 <br />71142010 - 60202107 <br />C/ 9 de abril casi Esq. Felix Pinto Nro 215 <br />Sant&iacute;sima Trinidad - Beni - Bolivia</p>
</td>
<td style="width: 36.4909%; text-align: right;">
<p><strong>Cliente:</strong> Nombre del cliente</p>
<p><strong>NIT:</strong> 123456789</p>
<p><strong>Cel:</strong> 75199157</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="height: 78px; width: 100%; border-collapse: collapse; border-style: solid;" border="1" cellpadding="5">
<thead>
<tr style="height: 13px; background-color: #770a0a;">
<th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Tipo</th>
<th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Equipo</th>
<th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Detalles</th>
<th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Diagn&oacute;stico</th>
</tr>
</thead>
<tbody>
<tr style="height: 13px;">
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
</tr>
<tr style="height: 13px;">
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
</tr>
<tr style="height: 13px;">
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
</tr>
<tr style="height: 13px;">
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
<td style="width: 24.9731%; height: 13px;">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="position: fixed; bottom: 0px; width: 100%;"><hr style="background-color: #770a0a;" size="2" />
<table style="height: 39px; width: 98.6058%; border-collapse: collapse;" border="0" cellpadding="5">
<tbody>
<tr style="height: 13px;">
<td style="width: 33.3333%; height: 13px;">&nbsp;</td>
<td style="width: 33.1217%; height: 13px;"><strong>Total neto Bs.</strong></td>
<td style="width: 33.4392%; height: 13px; text-align: right;"><strong style="font-size: 13px;">1000.00</strong></td>
</tr>
<tr style="height: 13px;">
<td style="width: 33.3333%; height: 13px;">&nbsp;</td>
<td style="width: 33.1217%; height: 13px;">Total IVA (13%)</td>
<td style="width: 33.4392%; height: 13px; text-align: right;">130.00</td>
</tr>
<tr style="height: 13px;">
<td style="width: 33.3333%; height: 13px;">&nbsp;</td>
<td style="width: 33.1217%; height: 13px;"><strong>Total Proforma Bs.</strong></td>
<td style="width: 33.4392%; height: 13px; text-align: right;"><strong style="font-size: 15px;">1130.00</strong></td>
</tr>
</tbody>
</table>
<hr style="background-color: #770a0a;" size="6" />
<p>&Eacute;sta proforma tiene un periodo de valides de 15 d&iacute;as a partir de la fecha de emisi&oacute;n</p>
</div>',
                'details' => NULL,
                'type' => 'rich_text_box',
                'order' => 6,
                'group' => 'Plantillas',
            ),
        ));
        
        
    }
}