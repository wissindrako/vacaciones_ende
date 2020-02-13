@extends("theme.$theme.layout")
@section('titulo')
Personas
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/persona/index.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensaje')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Usuarios</h3>
                <div class="box-tools pull-right">
                    <a href="{{route('crear_persona')}}" class="btn btn-block btn-success btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i> Nuevo registro
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover" id="tabla-data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>Cargo</th>
                            <th>Departamento</th>
                            <th>Haber Básico</th>
                            <th>Fecha de Ingreso</th>
                            <th>Administrar</th>
                            <th>Vacación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $data)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$data->nombre}} {{$data->paterno}} {{$data->materno}}</td>
                            <td>{{$data->codigo}}</td>
                            <td>{{$data->cargo}}</td>
                            <td>{{$data->dpto_seccion}}</td>
                            <td>{{$data->haber_basico}}</td>
                            <td>{{f_formato_d_m_Y($data->fecha_ingreso)}}</td>
                            <td>
                                <a href="{{route('editar_persona', ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </a>
                                <form action="{{route('eliminar_persona', ['id' => $data->id])}}" class="d-inline form-eliminar" method="POST">
                                    @csrf @method("delete")
                                    <button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">
                                        <i class="fa fa-fw fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{route('crear_vacacion', ['id_persona' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Agregar Vacaciones">
                                    <i class="fa fa-fw  fa-calendar-plus-o"></i>
                                </a>
                                <a href="{{route('ver_vacaciones', $data)}}" class="ver-vacaciones" class="btn-accion-tabla tooltipsC" title="Detalles">
                                    <i class="fa fa-fw fa-list-alt text-success"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-ver-vacaciones" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Vacaciones</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn-imprimir" class="btn btn-success pull-left">Imprimir</button>
            </div>
        </div>
    </div>
</div>
@endsection
