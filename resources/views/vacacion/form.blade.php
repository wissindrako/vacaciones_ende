<div class="form-group">
    <input type="hidden" name="persona_id" id="persona_id" class="form-control" value="{{ $data->id }}"/>
</div>
<div class="form-group">
    <label for="inicio" class="col-lg-3 control-label requerido">Fecha inicio</label>
    <div class="col-lg-8">
    <input type="text" name="inicio" id="inicio" class="form-control" value="{{old('inicio', $data->inicio ?? date('d-m-Y'))}}" required/>
    </div>
</div>
<div class="form-group">
    <label for="fin" class="col-lg-3 control-label requerido">Fecha fin</label>
    <div class="col-lg-8">
    <input type="text" name="fin" id="fin" class="form-control" value="{{old('fin', $data->fin ?? date('d-m-Y'))}}" required/>
    </div>
</div>
<div class="form-group">
    <label for="tiempo" class="col-lg-3 control-label requerido">Tiempo tomado</label>
    <div class="col-lg-8">
        <select class="form-control" name="tiempo_id" id="tiempo_id" required>
            <option value="" selected> --- SELECCIONE UN TIEMPO --- </option>
            @foreach ($tiempos as $tiempo)
                <option value={{$tiempo->id}} {{old('tiempo_id', 'selected' ?? '')}}>{{$tiempo->descripcion}}</option>
            @endforeach
        </select>
    </div>
</div>