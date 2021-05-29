@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', ($type == 'edit' ? 'Editar' : 'Agregar').' Mantenimientos')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-tools"></i>
        {{ ($type == 'edit' ? 'Editar' : 'Agregar').' Mantenimientos' }}
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <form role="form" action="{{ $type == 'edit' ? route('servicios.update', ["servicio" => $reg->id]) : route('servicios.store') }}" method="POST" enctype="multipart/form-data">
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

                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-6">
                                <label>Fecha estimada de entrega</label>
                                <input type="date" name="fecha_entrega" class="form-control" value="{{ isset($reg) ? $reg->fecha_entrega : old('fecha_entrega') }}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Técnico responsable</label>
                                <select name="empleado_id" id="select-empleado_id" class="form-control select2">
                                    <option @isset($reg) disabled @endisset value="">Ninguno</option>
                                    @foreach ($empleados as $item)
                                        <option @isset($reg) disabled @endisset value="{{ $item->id }}">{{ $item->nombre_completo }} - {{ $item->cargo->nombre ?? 'NN' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Costo total del servicio</label>
                                {{-- <input type="number" name="costo" min="0" step="0.5" class="form-control" value="{{ isset($reg) ? $reg->costo : old('costo') }}" /> --}}
                                <h3 class="text-muted text-right" id="label-total">0.00 Bs.</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>Equipo</th>
                                            <th>Descripción</th>
                                            <th>Evaluación</th>
                                            <th style="width: 150px">Precio</th>
                                            <th style="width: 50px"></th>
                                        </thead>
                                        <tbody id="table-detalle">
                                            <tr id="tr-ayuda">
                                                <td colspan="5">
                                                    <div class="alert alert-info">
                                                        <strong>Ayuda</strong>
                                                        <p>Presiona el botón <code>Agregar equipo</code> para agregar un item a la lista.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-dark btn-add"><i class="voyager-plus"></i> Agregar equipo</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea name="observaciones" class="form-control" rows="5" placeholder="En caso de haber alguna observación o recomendación, escrirla en este campo">{{ isset($reg) ? $reg->observaciones : old('observaciones') }}</textarea>
                            </div>
                            <div class="form-group col-md-12" style="margin-top: 30px">
                                <label>Imagenes</label>
                                <br>
                                @if(isset($reg->imagenes))
                                    <?php $images = json_decode($reg->imagenes); ?>
                                    @if($images != null)
                                        @foreach($images as $image)
                                            <div class="img_settings_container" style="float:left;padding-right:15px;">
                                                <a href="#" class="voyager-x remove-multi-image" style="position: absolute;" data-toggle="modal" data-target="#confirm_delete_modal" data-file_name="{{ $image }}"></a>
                                                <img src="{{ Voyager::image( str_replace('.', '-cropped.', $image) ) }}" style="max-width:150px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;">
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                                <div class="clearfix"></div>
                                <input type="file" name="imagenes[]" id="" multiple accept="image/*" />
                            </div>
                        </div>

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">Guardar</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de leiminar imagen --}}
    <form action="{{ route('servicios.remove.image', ['id' => $reg->id]) }}" method="post">
        <div class="modal fade modal-danger" id="confirm_delete_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="voyager-warning"></i> Confirmación</h4>
                    </div>
    
                    <div class="modal-body">
                        <h4>Deseas eliminar la imagen?</h4>
                        <input type="hidden" name="imagen" >
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" id="confirm_delete">Sí, eliminar!</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            var indexTable = 0;
            var tipoEquipos = @json($tipo_equipo);
            var optionsTipoEquipos = '';
            tipoEquipos.map(tipo => {
                optionsTipoEquipos += `<option value="${tipo.id}">${tipo.nombre}</option>`;
            });

            $('.btn-add').click(function(){
                addTr(indexTable, optionsTipoEquipos)
                indexTable++;
            });

            @isset ($reg)
                let reg = @json($reg);
                indexTable = reg.detalle.length;
                reg.detalle.map(item => {
                    addTr(indexTable, optionsTipoEquipos, item);
                    indexTable++;
                });

                $('#select-cliente_id').val(reg.cliente_id);
                $('#select-cliente_id').select2().trigger('change');

                $('#select-empleado_id').val(reg.empleado_id);
                $('#select-empleado_id').select2().trigger('change');

                getTotal();

            @endisset

            $('.remove-multi-image').click(function(){
                let image = $(this).data('file_name');
                console.log(image)
                $('#confirm_delete_modal input[name="imagen"]').val(image);
            });
        });

        function addTr(indexTable, optionsTipoEquipos, data = null){
            $('#table-detalle').append(`
                <tr id="tr-${indexTable}" class="tr-item">
                    <td>
                        <select name="tipo_equipo_id[]" id="select-tipo_equipo_id-${indexTable}" class="form-control" required>${optionsTipoEquipos}</select>
                        <input type="text" name="equipo[]" class="form-control" placeholder="PC Sure 2021" value="${data ? data.equipo : ''}" required/>
                    </td>
                    <td>
                        <input type="text" name="descripcion[]" class="form-control" placeholder="2 GB RAM, Dual core..." value="${data ? data.descripcion ? data.descripcion : '' : ''}" />
                        <input type="text" name="problema[]" class="form-control" placeholder="Problemas al encender..." value="${data ? data.problema : ''}" required/>
                    </td>
                    <td>
                        <input type="text" name="diagnostico[]" class="form-control" placeholder="Ingrese el diagnóstico" value="${data ? data.diagnostico ? data.diagnostico : '' : ''}" />
                        <input type="text" name="solucion[]" class="form-control" placeholder="Describa la posible solución" value="${data ? data.solucion ? data.solucion : '' : ''}" />
                    </td>
                    <td><input type="number" min="0" step="0.5" style="height: 70px; text-align: right; font-size: 25px" name="precio[]" class="form-control input-subtotal" onchange="getTotal()" onkeyup="getTotal()" placeholder="100" value="${data ? data.precio ? data.precio : '' : ''}" /></td>
                    <td><button type="button" onclick="removeTr(${indexTable})" class="btn btn-link"><i class="voyager-trash text-danger"></i></button></td>
                </tr>
            `);

            if(data){
                $(`#select-tipo_equipo_id-${indexTable}`).val(data.tipo.id);
            }
            showHelp();
        }

        function removeTr(index){
            $(`#tr-${index}`).remove();
            showHelp();
            getTotal();
        }

        function showHelp(){
            let show = document.getElementsByClassName("tr-item").length > 0 ? false : true;
            if(show){
                $('#tr-ayuda').fadeIn();
            }else{
                $('#tr-ayuda').fadeOut('fast');
            }
        }

        function getTotal(){
            let total = 0;
            $('.input-subtotal').each(function(){
                total += $(this).val() ? parseFloat($(this).val()) : 0;
            });
            $('#label-total').text(`${total.toFixed(2)} Bs.`);
        }
    </script>
@stop
