<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proforma</title>
</head>
<body>
    @php
        $proforma = setting('plantillas.proforma_servicios');
        $proforma = str_replace("#fecha#", date('d-m-Y', strtotime($reg->created_at)), $proforma);
        $proforma = str_replace("#razon_social#", $reg->cliente->nombre_completo, $proforma);
        $proforma = str_replace("#nit#", $reg->cliente->nit ?? 'NN', $proforma);
        $proforma = str_replace("#celular#", $reg->cliente->celular ?? 'NN', $proforma);
        
        $detalle = '';
        $total = 0;
        foreach ($reg->detalle as $item) {
            $detalle .= '
                <tr>
                    <td>'.$item->producto->nombre.'<br> <small style="color: #585858">'.$item->detalle.'</small></td>
                    <td style="text-align: right">'.$item->cantidad.'</td>
                    <td style="text-align: right">'.$item->costo.'</td>
                    <td style="text-align: right">'.number_format($item->cantidad*$item->costo, 2, ',', '.').'</td>    
                </tr>
            ';
            $total += $item->cantidad*$item->costo;
        }

        $proforma = str_replace("#monto#", number_format($total, 2, '.', ''), $proforma);

        $detalle = '
        <table style="height: 78px; width: 100%; border-collapse: collapse; border-style: solid;" border="1" cellpadding="5">
            <thead>
                <tr style="height: 13px; background-color: #770a0a;">
                <th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Detalle</th>
                <th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Cantidad</th>
                <th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Precio</th>
                <th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Subtotal</th>
                </tr>
            </thead>
            <tbody>'.$detalle.'</tbody>
        </table>';
        $proforma = str_replace('#detalles#', $detalle, $proforma);
    @endphp
    {!! $proforma !!}
    <script>
        window.print();
    </script>
</body>
</html>