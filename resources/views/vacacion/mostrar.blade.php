{{-- {{dd($data)}} --}}
{{-- <div>{{$gestiones[0]['gestion']}}</div>
<div>{{$data->paterno}}</div>
<div>{{$data->materno}}</div> --}}
{{-- <div><img src="{{Storage::url("imagenes/caratulas/$persona->foto")}}" alt="Caratula del libro"></div> --}}

<div class="box box-solid" id="areaImprimir">
    <div class="box-header with-border">
      <i class="fa fa-calendar"></i>

      <h3 class="box-title">Vacaciones</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <ol>
          @foreach ($gestiones as $gestion)
            <li> <b>Fecha Inicio: </b> {{ f_formato_d_m_Y($gestion['fecha_inicio'])}} - <b>Fecha Fin: </b>{{ f_formato_d_m_Y($gestion['fecha_fin'])}} - <b>Días según Escala: </b> {{$gestion['dias_vacacion']}} <br></li>
          @endforeach
            <hr>
          <ol>
            @foreach ($vacaciones as $vacacion)
                <li> {{ f_formato_d_m_Y($vacacion->inicio)}} - {{ f_formato_d_m_Y($vacacion->fin)}}</li>
            @endforeach
          </ol>
      </ol>
    </div>
    <!-- /.box-body -->
</div>