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
            Imprimir</a>
    </h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <form action="{{ route('servicios.proforma.update', ['id' => $reg->id]) }}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <textarea class="form-control richTextBox" name="proforma" id="richtext">{{ $reg->proforma ?? setting('plantillas.proforma_servicios') }}</textarea>
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
