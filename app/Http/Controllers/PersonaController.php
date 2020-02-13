<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\Vacacion;
use App\Http\Requests\ValidacionPersona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Persona::all()->sortBy('id');
        return view('persona.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('persona.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionPersona $request)
    {
        if ($fecha_ingreso = Persona::setFecha($request->fecha_ingreso))
        $request->request->add(['fecha_ingreso' => $fecha_ingreso]);
        $persona = Persona::create($request->all());
        return redirect('persona/crear')->with('mensaje', 'Usuario creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrar(Request $request, Persona $persona)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = Persona::findOrFail($request->id_persona);
            $gestiones = Vacacion::gestionesPorPersona($request->id_persona);
            $vacaciones = Vacacion::vacacionesPorPersona($request->id_persona);
            return view('vacacion.mostrar', compact('data', 'vacaciones', 'gestiones'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Persona::findOrFail($id);
        return view('persona.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionPersona $request, $id)
    {
        $usuario = Persona::findOrFail($id);
        if ($fecha_ingreso = Persona::setFecha($request->fecha_ingreso))
        $request->request->add(['fecha_ingreso' => $fecha_ingreso]);
        $usuario->update(array_filter($request->all()));
        return redirect('persona')->with('mensaje', 'Usuario actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        if ($request->ajax()) {
            $usuario = Persona::findOrFail($id);
            $usuario->delete();
            return response()->json(['mensaje' => 'ok']);
         } else {
            abort(404);
        }
    }
}
