@extends('voyager::master')

@section('page_title', 'Viendo Servicios')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-folder"></i> Servicios
        </h1>
        {{-- @can('add_servicios') --}}
            <a href="{{ route('servicios.create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>Crear</span>
            </a>
        {{-- @endcan --}}
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de etapas --}}
    <form action="{{ route('servicios.etapas.store') }}" id="etapa_form" method="POST">
        @csrf
        <input type="hidden" name="servicio_id">
        <div class="modal modal-success fade" tabindex="-1" id="etapa_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-tag"></i> Cambiar etapa del servicio</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Etapa</label>
                            <select name="servicios_estado_id" id="select-servicios_estado_id" class="form-control" required>
                                @foreach ($estados as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Costo total</label>
                            <input type="number" name="costo" min="0" step="0.5" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group" id="form-group-empleado_id">
                            <label>Técnico responsable</label>
                            <select name="empleado_id" id="select-empleado_id" class="form-control" required>
                                <option value="">Ninguno</option>
                                @foreach ($empleados as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre_completo }} - {{ $item->cargo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-success pull-right delete-confirm" value="Guardar">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Entrega modal --}}
    <form action="#" id="entrega_form" method="POST">
        <div class="modal modal-primary fade" tabindex="-1" id="entrega_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-check-circle"></i> Entrega y cierre del servicio</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-warning"><i class="voyager-warning"></i> Si realiza ésta acción no podras revertirla y el servicio se registrará como entregado y cobrado!</p>
                        <div class="form-group">
                            <textarea name="observaciones" class="form-control" rows="5" placeholder="Puedes escribir las observaciones finales..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-dark pull-right delete-confirm" value="Sí, servicio entregado">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Desea eliminar el siguiente registro?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script src="{{ url('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
            let columns = [
                { data: 'id', title: 'id' },
                { data: 'cliente', title: 'Cliente' },
                { data: 'detalles', title: 'Detalles' },
                { data: 'estado', title: 'Etapa' },
                { data: 'observaciones', title: 'Observaciones' },
                { data: 'action', title: 'Acciones', orderable: false, searchable: false },
            ]
            customDataTable("{{ url('admin/servicios/ajax/list') }}", columns);
        });

        function changeStatus(data){
            let estados_servicio = data.estados_servicio;
            console.log(data)
            $('#select-servicios_estado_id').val(estados_servicio[estados_servicio.length -1].estado.id);
            $('#select-empleado_id').val(data.empleado_id);
            $('#etapa_form input[name="servicio_id"]').val(data.id);
            $('#etapa_form input[name="costo"]').val(data.costo);
            $('#etapa_form textarea[name="observaciones"]').val(data.observaciones);

            if(data.empleado_id){
                $('#form-group-empleado_id').fadeOut('fast');
            }else{
                $('#form-group-empleado_id').fadeIn('fast');
            }
        }

        function deleteItem(id){
            let url = '{{ url("admin/servicios") }}/'+id;
            $('#delete_form').attr('action', url);
        }

        function EntregaItem(id){
            let url = '{{ url("admin/servicios/entregado") }}/'+id;
            $('#entrega_form').attr('action', url);
        }
    </script>
@stop
