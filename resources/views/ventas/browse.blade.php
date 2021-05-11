@extends('voyager::master')

@section('page_title', 'Viendo Ventas')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="voyager-basket"></i> Ventas
                </h1>
                <a href="{{ route('ventas.create') }}" class="btn btn-success btn-add-new">
                    <i class="voyager-plus"></i> <span>Crear</span>
                </a>
            </div>
            <div class="col-md-4">

            </div>
        </div>
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
            let searchParams = new URLSearchParams(window.location.search)
            let estado = searchParams.get('estado')
            $('#select-estado').val(estado);

            $('[data-toggle="tooltip"]').tooltip()
            let columns = [
                { data: 'id', title: 'id' },
                { data: 'cliente', title: 'Cliente' },
                { data: 'detalle', title: 'Detalle' },
                { data: 'fecha', title: 'Fecha' },
                { data: 'total', title: 'Total' },
                { data: 'action', title: 'Acciones', orderable: false, searchable: false },
            ]
            customDataTable("{{ url('admin/ventas/ajax/list') }}/", columns);

            @if(Session::has('print'))
                let print = "{{ Session::get('print') }}"
                if(print != 0){
                    let url = "{{ url('admin/ventas/#id/proforma/generate') }}"
                    window.open(url.replace('#id', print), '_blank');
                }
            @endif
        });

        function deleteItem(id){
            let url = '{{ url("admin/ventas") }}/'+id;
            $('#delete_form').attr('action', url);
        }

    </script>
@stop
