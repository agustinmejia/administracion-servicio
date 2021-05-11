@extends('voyager::master')

@section('page_title', 'Ver Servicio')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-folder"></i> Servicio
        {{-- <a href="{{ route('servicios.edit', ['servicio' => $id]) }}" class="btn btn-info">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;
            Editar
        </a> --}}
        <a href="{{ route('ventas.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver a la lista
        </a>
        @if ($reg->proforma)
        <a href="{{ route('ventas.proforma.generate', ['id' => $reg->id]) }}" target="_blank" title="Ver" class="btn btn-sm btn-info view">
            <i class="voyager-file-text"></i> <span class="hidden-xs hidden-sm">Imprimir</span>
        </a>
        @endif
    </h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Nombre Completo/Empresa</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $reg->cliente->nombre_completo }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-4">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Atendido por</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $reg->empleado->name }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-4">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Fecha de venta</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ date('d-M-Y', strtotime($reg->created_at)) }} <small>{{ \Carbon\Carbon::parse($reg->created_at)->diffForHumans() }}</small></p>
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
                                                <th>Detalle</th>
                                                <th style="text-align: right">Cantidad</th>
                                                <th style="text-align: right">Precio</th>
                                                <th style="text-align: right">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($reg->detalle as $item)
                                                <tr>
                                                    <td>{{ $item->producto->nombre }} <br> <small class="text-muted">{{ $item->detalle }}</small> </td>
                                                    <td style="text-align: right">{{ $item->cantidad }}</td>
                                                    <td style="text-align: right">{{ $item->costo }}</td>
                                                    <td style="text-align: right">{{ number_format($item->cantidad*$item->costo, 2, ',', '.') }}</td>
                                                </tr>
                                                @php
                                                    $total += $item->cantidad*$item->costo;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="3"><b>Total</b></td>
                                                <td style="text-align: right"><h4>{{ number_format($total, 2, ',', '.') }}</h4></td>
                                            </tr>
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
