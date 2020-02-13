<div class="form-group">
    <label for="nombre" class="col-lg-3 control-label requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $data->nombre ?? '')}}" required/>
    </div>
</div>
<div class="form-group">
    <label for="paterno" class="col-lg-3 control-label">Paterno</label>
    <div class="col-lg-8">
        <input type="text" name="paterno" id="paterno" class="form-control" value="{{old('paterno', $data->paterno ?? '')}}"/>
    </div>
</div>
<div class="form-group">
    <label for="materno" class="col-lg-3 control-label ">Materno</label>
    <div class="col-lg-8">
        <input type="text" name="materno" id="materno" class="form-control" value="{{old('materno', $data->materno ?? '')}}"/>
    </div>
</div>
<div class="form-group">
    <label for="codigo" class="col-lg-3 control-label requerido">Código de Empleado</label>
    <div class="col-lg-8">
        <input type="text" name="codigo" id="codigo" class="form-control" value="{{old('codigo', $data->codigo ?? '')}}" required/>
    </div>
</div>
<div class="form-group">
    <label for="cargo" class="col-lg-3 control-label">Cargo</label>
    <div class="col-lg-8">
        <input type="text" name="cargo" id="cargo" class="form-control" value="{{old('cargo', $data->cargo ?? '')}}"/>
    </div>
</div>
<div class="form-group">
    <label for="dpto_seccion" class="col-lg-3 control-label">Departamento o Sección</label>
    <div class="col-lg-8">
        <input type="text" name="dpto_seccion" id="dpto_seccion" class="form-control" value="{{old('dpto_seccion', $data->dpto_seccion ?? '')}}"/>
    </div>
</div>
<div class="form-group">
    <label for="haber_basico" class="col-lg-3 control-label requerido">Haber básico</label>
    <div class="col-lg-8">
        <input type="number" min="0" name="haber_basico" id="haber_basico" class="form-control" value="{{old('haber_basico', $data->haber_basico ?? '0')}}"/>
    </div>
</div>
<div class="form-group">
    <label for="fecha_ingreso" class="col-lg-3 control-label requerido">Fecha de Ingreso</label>
    <div class="col-lg-8">
        {{-- Ponemos en un IF convencional ya que genera error al llamar 
            con la funcion del Helper en lugar de llamar directamente --}}
            {{-- <input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{old('fecha_ingreso', f_formato_d_m_Y($data->fecha_ingreso) ?? date('d-m-Y'))}}" required/> --}}
            {{-- <input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{old('fecha_ingreso', $data->fecha_ingreso ?? date('d-m-Y'))}}" required/> --}}
        @if (old('fecha_ingreso', $fecha=$data->fecha_ingreso ?? $fecha=date('d-m-Y')))
        <input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ f_formato_d_m_Y($fecha) }}" required/>
        @else
        <input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ $fecha }}" required/>
        @endif
    
    </div>
</div>
