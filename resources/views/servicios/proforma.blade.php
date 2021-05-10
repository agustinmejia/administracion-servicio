@extends('voyager::master')

@section('page_title', 'Profroma de Servicio')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-folder"></i> Profroma de Servicio
        <a href="{{ route('servicios.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver a la lista
        </a>
        <a href="{{ route('servicios.proforma.print', ['id' => $reg->id]) }}" class="btn btn-danger" target="_blank">
            <span class="glyphicon glyphicon-print"></span>&nbsp;
            Imprimir
        </a>
        <a href="{{ route('servicios.proforma.reset', ['id' => $reg->id]) }}" class="btn btn-primary">
            <span class="voyager-refresh"></span>&nbsp;
            Resetear
        </a>
    </h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <form action="{{ route('servicios.proforma.update', ['id' => $reg->id]) }}" method="post">
                @csrf
                @php
                    $proforma = $reg->proforma ?? setting('plantillas.proforma_servicios');
                    $proforma = str_replace("#fecha#", date('d-m-Y'), $proforma);
                    $proforma = str_replace("#razon_social#", $cliente->nombre_completo, $proforma);
                    $proforma = str_replace("#nit#", $cliente->nit ?? 'NN', $proforma);
                    $proforma = str_replace("#celular#", $cliente->celular, $proforma);
                    $proforma = str_replace("#monto#", number_format($reg->costo, 2, '.', ''), $proforma);
                    $detalle = '';
                    foreach ($detalles as $item) {
                        $detalle .= '
                            <tr>
                                <td>'.$item->nombre.'</td>
                                <td>'.$item->equipo.'</td>
                                <td>'.$item->descripcion.'</td>
                                <td>'.$item->diagnostico.'</td>    
                            </tr>
                        ';
                    }
                    $detalle = '
                    <table style="height: 78px; width: 100%; border-collapse: collapse; border-style: solid;" border="1" cellpadding="5">
                        <thead>
                            <tr style="height: 13px; background-color: #770a0a;">
                            <th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Tipo</th>
                            <th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Equipo</th>
                            <th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Detalles</th>
                            <th style="height: 13px; width: 24.9731%; color: white; font-size: 15px;">Diagn&oacute;stico</th>
                            </tr>
                        </thead>
                        <tbody>'.$detalle.'</tbody>
                    </table>';
                    $proforma = str_replace('#detalles#', $detalle, $proforma);
                @endphp
                <div class="col-md-12">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <textarea class="form-control richTextBox" name="proforma" id="richtext">{{ $proforma }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            var additionalConfig = {
                selector: 'textarea.richTextBox[name="proforma"]',
            }
            tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
        });
    </script>
@stop
