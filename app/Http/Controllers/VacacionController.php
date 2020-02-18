<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionVacacion;
use App\Models\Vacacion;
use App\Models\Persona;
use App\Models\Tiempo;
use Carbon\Carbon;

use Faker\Provider\ar_JO\Person;

class VacacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Persona::all()->sortBy('id');
        return view('vacacion.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id_persona)
    {
        $data = Persona::findOrFail($id_persona);
        $tiempos = Tiempo::all();
        return view('vacacion.crear', compact('data', 'tiempos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionVacacion $request)
    {

        if ($inicio = Vacacion::setFechaVacacion($request->inicio))
        $request->request->add(['inicio' => $inicio]);

        if ($fin = Vacacion::setFechaVacacion($request->fin))
        $request->request->add(['fin' => $fin]);

        if ($dias_tomados = Vacacion::setDiasTomados($request->inicio, $request->fin, $request->tiempo_id))
        $request->request->add(['dias_tomados' => $dias_tomados]);

        // $disponibilidad_por_dia = Vacacion::disponibilidadPorDia($fecha_vacacion, $request->persona_id);

        // $disponibilidad_por_gestion = Vacacion::disponibilidadPorGestion($fecha_vacacion, $request->persona_id);


        // return $disponibilidad_por_gestion;
        // echo "<pre>";
        // return print_r($disponibilidad_por_gestion);

        //Disponibilidad por Gestion
        // $saldo = Vacacion::disponibilidadPorGestion($fecha_vacacion, $request->persona_id);

        //Disponibilidad por Persona
        $disponibilidad_por_persona = Vacacion::gestionesPorPersona($request->persona_id);
        if ($disponibilidad_por_persona->sum('saldo') > 0) {
            $vacacion = Vacacion::create($request->all());
        return redirect('vacacion/crear/'.$request->persona_id)->with('mensaje', 'Fecha agregada con exito');
        }else {
            return redirect('vacacion/crear/'.$request->persona_id)->withErrors(['error' => 'Vacaciones disponibles para esa Gestion: '.$disponibilidad_por_persona->sum('saldo').' día(s)' ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrar($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        //
    }
}
