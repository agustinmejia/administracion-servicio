@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', ($type == 'edit' ? 'Editar' : 'Agregar').' Venta')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-basket"></i>
        {{ ($type == 'edit' ? 'Editar' : 'Agregar').' Venta' }}
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <form role="form" action="{{ $type == 'edit' ? route('ventas.update', ["servicio" => $reg->id]) : route('ventas.store') }}" method="POST" enctype="multipart/form-data">
                        @if($type == 'edit')
                            {{ method_field("PUT") }}
                        @endif

                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (session('error_detalle'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ session('error_detalle') }}</li>
                                    </ul>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Poroductos y servicios</label>
                                            <select name="cliente_id" id="select-productos_id" class="form-control select2" required>
                                                <option disabled selected value="">-- Seleccionar el producto o servicio --</option>
                                                @foreach ($productos as $item)
                                                    <option data-item='@json($item)'>{{ $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="col-md-12" style="margin-top: 20px" id="div-empty-list">
                                                <h3 class="text-muted text-center">Lista vacía</h3>
                                            </div>
                                            <table class="table" style="display: none" id="table-list">
                                                <thead>
                                                    <th>Producto/Servicio</th>
                                                    <th style="width: 100px">Costo</th>
                                                    <th style="width: 100px">Cantidad</th>
                                                    <th>Detalle</th>
                                                    <th>Total</th>
                                                    <th style="width: 50px"></th>
                                                </thead>
                                                <tbody id="table-detalle"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <select name="cliente_id" id="select-cliente_id" class="form-control select2" required>
                                            <option disabled selected value="">-- Seleccionar cliente --</option>
                                            @foreach ($clientes as $item)
                                                <option value="{{ $item->id }}">{{ $item->nombre_completo }} - {{ $item->nit ?? 'NN' }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('cliente_id'))
                                            @foreach ($errors->get('cliente_id') as $error)
                                                <span class="help-block text-danger">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <textarea name="observaciones" class="form-control" rows="3" placeholder="Observaciones">{{ isset($reg) ? $reg->observaciones : old('observaciones') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <h3 class="text-right" id="label-total">0.00 Bs.</h3>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="proforma" value="1" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                          Generar solo proforma
                                        </label>
                                      </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Guardar venta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            var indexTable = 0;

            $('#select-productos_id').change(function(){
                let producto = $('#select-productos_id option:selected').data('item');
                addTr(indexTable, producto);
                indexTable += 1;
            });

        });

        function addTr(indexTable, data){
            console.log(indexTable)
            $('#table-detalle').append(`
                <tr id="tr-${indexTable}" class="tr-item">
                    <td><input type="hidden" name="producto_id[]" class="form-control" placeholder="PC Sure 2021" value="${data.id}" required/>${data.nombre}</td>
                    <td><input type="text" name="precio[]" readonly class="form-control" value="${data.precio}" id="input-precio-${indexTable}" required/></td>
                    <td><input type="number" step="1" min="1" name="cantidad[]" class="form-control" onchange="subTotal(${indexTable})" onkeyup="subTotal(${indexTable})" value="1" id="input-cantidad-${indexTable}" required/></td>
                    <td><input type="text" name="detalle[]" class="form-control" placeholder="detalles adicionales"/></td>
                    <td><input type="hidden" class="input-total" id="input-total-${indexTable}" value="${data.precio}" /><h4 id="label-total-${indexTable}">${data.precio} Bs.</h4></td>
                    <td><button type="button" onclick="removeTr(${indexTable})" class="btn btn-link"><i class="voyager-trash text-danger"></i></button></td>
                </tr>
            `);
            showHelp();
            total();
        }

        function subTotal(index){
            let precio = parseFloat($(`#input-precio-${index}`).val());
            let cantidad = parseFloat($(`#input-cantidad-${index}`).val());
            $(`#label-total-${index}`).text(`${(precio*cantidad).toFixed(2)} Bs.`);
            $(`#input-total-${index}`).val(precio*cantidad);
            total();
        }

        function total(){
            let total = 0;
            $('.input-total').each(function(){
                total += parseFloat($(this).val());
            });
            $(`#label-total`).text(`${(total).toFixed(2)} Bs.`);
        }

        function removeTr(index){
            $(`#tr-${index}`).remove();
            showHelp();
            total();
        }

        function showHelp(){
            let show = document.getElementsByClassName("tr-item").length > 0 ? false : true;
            if(show){
                $('#div-empty-list').fadeIn('fast');
                $('#table-list').fadeOut();
            }else{
                $('#div-empty-list').fadeOut('fast');
                $('#table-list').fadeIn();
            }
        }
    </script>
@stop
