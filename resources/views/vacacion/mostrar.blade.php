{{-- {{dd($data)}} --}}
{{-- <div>{{$gestiones[0]['gestion']}}</div>
<div>{{$data->paterno}}</div>
<div>{{$data->materno}}</div> --}}
{{-- <div><img src="{{Storage::url("imagenes/caratulas/$persona->foto")}}" alt="Caratula del libro"></div> --}}

<div class="box box-solid" id="areaImprimir">
{{-- {{dd($gestiones)}} --}}
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Cálculo por Gestiones</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table table-condensed">
            <tbody>
            <tr>
              <th style="width: 10px">#</th>
              <th>Desde</th>
              <th>Hasta</th>
              <th style="">Días de vacación</th>
            </tr>
                @foreach ($gestiones as $key => $gestion)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ f_formato_d_m_Y($gestion['fecha_inicio'])}}</td>
                    <td>{{ f_formato_d_m_Y($gestion['fecha_fin'])}} </td>
                    <td>{{$gestion['dias_vacacion']}}</td>
                </tr>
                @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Días de vacación tomados</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table table-condensed">
            <tbody>
            <tr>
              <th style="width: 10px">#</th>
              <th>Días tomados en boletas</th>
              <th>Cantidad</th>
              <th style="">Días</th>
            </tr>
            @foreach ($vacaciones as $key => $vacacion)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ f_formato_d_m_Y($vacacion->inicio)}} <b> &nbsp;&nbsp;al &nbsp;&nbsp; </b> {{ f_formato_d_m_Y($vacacion->fin)}} </td>
                    <td>{{$vacacion->dias_tomados}}</td>
                    <td>{{$vacacion->tiempo_descripcion}}</td>
                </tr>
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>

</div>

    <!-- /.row -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
                <h3 class="box-title">Resumen de Vacaciones</h3>


            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                <tbody><tr>
                    {{-- <th style="width: 10px">#</th> --}}
                    <th style="width: 80px">Descripción</th>
                    <th></th>
                    <th style="width: 40px">Días</th>
                </tr>
                <tr>
                    <td>Días de vacación</td>
                    <td>
                    <div class="progress progress-xs progress-striped">
                        <div class="progress-bar progress-bar-primary" style="width: {{$gestiones->sum('dias_vacacion')/$gestiones->sum('dias_vacacion')*100}}%"></div>
                    </div>
                    </td>
                <td><span class="badge bg-light-blue">{{$gestiones->sum('dias_vacacion')}}</span></td>
                </tr>
                <tr>
                    <td>Días tomados</td>
                    <td>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: {{$vacaciones->sum('dias_tomados')/$gestiones->sum('dias_vacacion')*100}}%"></div>
                    </div>
                    </td>
                <td><span class="badge bg-red">{{$vacaciones->sum('dias_tomados')}}</span></td>
                </tr>
                <tr>
                    <td>Saldo</td>
                    <td>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-success" style="width: {{($gestiones->sum('dias_vacacion')-$vacaciones->sum('dias_tomados'))/$gestiones->sum('dias_vacacion')*100}}%"></div>
                    </div>
                    </td>
                    <td><span class="badge bg-green">{{$gestiones->sum('dias_vacacion')-$vacaciones->sum('dias_tomados')}}</span></td>
                </tr>

                {{-- <tr>
                    <td>Fix and squish bugs</td>
                    <td>
                    <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                    </div>
                    </td>
                    <td><span class="badge bg-green">90%</span></td>
                </tr> --}}
                </tbody></table>
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        </div>
