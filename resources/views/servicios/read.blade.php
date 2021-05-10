@extends('voyager::master')

@section('page_title', 'Ver Servicio')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-folder"></i> Servicio
        <a href="{{ route('servicios.edit', ['servicio' => $id]) }}" class="btn btn-info">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;
            Editar
        </a>
        <a href="{{ route('servicios.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver a la lista
        </a>
    </h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Nombre Completo/Empresa</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $reg->cliente->nombre_completo }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Empleado a cargo</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $reg->empleado ? $reg->empleado->nombre_completo.( $reg->empleado->cargo ? ' - '.$reg->empleado->cargo->nombre : '' ) : 'No definido' }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Fecha ingreso</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ date('d-M-Y', strtotime($reg->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($reg->created_at)->diffForHumans() }}</small></p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Fecha de entrega</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                @if ($reg->fecha_entrega)
                                    <p>{{ date('d-M-Y', strtotime($reg->fecha_entrega)) }} <br> <small>{{ \Carbon\Carbon::parse($reg->fecha_entrega)->diffForHumans() }}</small></p>                                    
                                @else
                                    No definido
                                @endif
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Etapa actual</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                @php
                                    $etapa = 'No definida';
                                    foreach($reg->estados_servicio as $item){
                                        $etapa = $item->estado->nombre;
                                    }
                                @endphp
                                <label class="label label-default">{{ $etapa }}</label>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Costo del servicio</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $reg->costo ? $reg->costo.' Bs.' : 'No definido' }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-12">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Observaciones</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $reg->observaciones ?? 'Ninguna' }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-12">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Detalle del servicio</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Equipo</th>
                                                <th>Descripción</th>
                                                <th>Problema</th>
                                                <th>Solución</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reg->detalle as $item)
                                                <tr>
                                                    <td>{{ $item->tipo->nombre }}</td>
                                                    <td>{{ $item->equipo }}</td>
                                                    <td>{{ $item->descripcion ?? 'No definida' }}</td>
                                                    <td>{{ $item->problema }}</td>
                                                    <td>{{ $item->solucion ?? 'No definida' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr style="margin:0;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function () {

        });
    </script>
@stop
