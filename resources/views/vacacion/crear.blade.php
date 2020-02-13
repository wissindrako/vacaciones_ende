@extends("theme.$theme.layout")
@section('titulo')
    Vacación
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/usuario/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensaje')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ingresar Vacación de <b>{{ $data->nombre }} {{ $data->paterno }} {{ $data->materno }}</b></h3>
                <br>
                <h3 class="box-title">Código <b>{{ $data->codigo }}</b></h3>
                <div class="box-tools pull-right">
                    <a href="{{route('persona')}}" class="btn btn-block btn-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver al listado
                    </a>
                </div>
            </div>
            <form action="{{route('guardar_vacacion')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                @csrf
                <div class="box-body">
                    @include('vacacion.form')
                </div>
                <div class="box-footer">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        @include('includes.boton-form-crear')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
