<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vacacion extends Model
{
    protected $table = 'vacaciones';
    protected $fillable = ['persona_id', 'inicio', 'fin', 'dias_tomados', 'tiempo_id'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function tiempo()
    {
        return $this->belongsTo(Tiempo::class, 'tiempo_id');
    }

    public static function disponibilidadPorGestion($fecha_vacacion, $persona_id){
        $gestiones_por_persona = self::gestionesPorPersona($persona_id);
        
        $saldo = -1;
        
        foreach ($gestiones_por_persona as $key => $value) {
            # code...
            if ($fecha_vacacion >= $value['fecha_inicio'] && $fecha_vacacion < $value['fecha_fin']) {
                $saldo = $value['saldo'];
                break;
            }
        }
        return $saldo;
    }
   
    public static function gestionesPorPersona($persona_id)
    {
        # code...
        $fecha_ingreso = Persona::find($persona_id)->fecha_ingreso;
        $fecha_ingreso = Carbon::parse($fecha_ingreso);

        // Obteniendo el total de Gestiones
        $fecha_actual = Carbon::now();
        $n_gestiones = $fecha_ingreso->diffInDays($fecha_actual);
        $n_gestiones = intval($n_gestiones/365);

       
        if ($n_gestiones > 0) {
            # code...
            $data = [];
            $fechas_excluidas = [];
            
            for ($i=0; $i < $n_gestiones; $i++) {
            
                //Obteniendo fechas de inicio y fin de cada gestion
                $fecha = $fecha_ingreso->toDateTimeString();
                $fecha_inicio = strtotime('+'.($i+1).' year', strtotime($fecha));
                $fecha_inicio = date('Y-m-d', $fecha_inicio);

                $fecha_fin = strtotime('+'.($i+2).' year', strtotime($fecha));
                $fecha_fin = date('Y-m-d', $fecha_fin);

                if ($fecha_fin <= date('Y-m-d')) {
                //Calculando dias de vacacion segun escala
                $antiguedad = $fecha_ingreso->diff($fecha_fin);
                $a = $antiguedad->y;
                $m = $antiguedad->m;
                $d = $antiguedad->d;

                $dias_vacacion = self::escala($a, $m, $d);
                $dias_tomados_gestion = self::sumaVacacionesTomadasGestion($fecha_inicio, $fecha_fin, $persona_id);
                
                // $vacaciones = Vacacion::getVacaciones($persona_id, $dias_vacacion, $fechas_excluidas);
                $vacaciones = [];
                
                if (count($vacaciones) > 0) {
                    $fechas_excluidas = $vacaciones->pluck('id');
                } else {
                    $fechas_excluidas = [];

                }
                
                $data[$i] = [
                            'gestion' => $i+1,
                            'fecha_inicio' => $fecha_inicio,
                            'fecha_fin' => $fecha_fin,
                            'dias_vacacion' => $dias_vacacion,
                            'dias_tomados' => $dias_tomados_gestion,
                            'saldo' => $dias_vacacion - $dias_tomados_gestion,
                            'submenu' => $vacaciones
                            ];
                }

            }
        } else {
            $data = [];
        }
        // return $data;
        return collect($data); 
    }

    public static function vacacionesPorPersona($persona_id)
    {
        $fechas_dia = \DB::table('vacaciones')
        ->join('tiempo', 'vacaciones.tiempo_id', 'tiempo.id')
        ->where('persona_id', $persona_id)
        ->select('vacaciones.id', 'persona_id', 'inicio', 'fin', 'dias_tomados',
        'tiempo_id'
        )
        ->get();
        return $fechas_dia;
    }

    //
    public static function getVacaciones($persona_id, $dias_vacacion, $fechas_excluidas)
    {
        $fechas_dia = \DB::table('vacaciones')
        ->join('tiempo', 'vacaciones.tiempo_id', 'tiempo.id')
        ->where('persona_id', $persona_id)
        ->whereNotIn('vacaciones.id', $fechas_excluidas)
        ->select('vacaciones.id', 'persona_id', 'inicio', 'fin', 'dias_tomados',
        'tiempo_id'
        )
        ->get();
        $dias_tomados = 0;
        $ultimo_id = 0;
        if (count($fechas_dia) > 0) {
            # Si se tiene vacaciones tomadas en esa Fecha
            foreach ($fechas_dia as $key => $value) {
                $dias_tomados = $value->dias_tomados + $dias_tomados;
                if ($dias_tomados <= $dias_vacacion) {
                    $ultimo_id = $value->id;
                }else{
                    break;
                }
            }
            return $fechas_dia->where('id', '<=', $ultimo_id);

        } else {
            # Si no hay vacaciones tomadas en esa Fecha
            return [];

        }
    }

    public static function disponibilidadPorDia($fecha_vacacion, $persona_id)
    {
        $fechas_dia = \DB::table('vacaciones')
        ->join('tiempo', 'vacaciones.tiempo_id', 'tiempo.id')
        ->where('fecha_vacacion', $fecha_vacacion)
        ->where('persona_id', $persona_id)
        ->select('vacaciones.fecha_vacacion',
            \DB::raw('SUM(tiempo.valor) as dias')
        )
        ->groupBy('vacaciones.fecha_vacacion')
        ->get();

        if (count($fechas_dia) > 0) {
            # Si se tiene vacaciones tomadas en esa Fecha
            return $fechas_dia[0]->dias;
        } else {
            # Si no hay vacaciones tomadas en esa Fecha
            return 0;
        }
    }

    public static function sumaVacacionesTomadasGestion($fecha_inicio, $fecha_fin, $persona_id)
    {
        $fechas_dia = \DB::table('vacaciones')
        ->join('tiempo', 'vacaciones.tiempo_id', 'tiempo.id')
        ->where('persona_id', $persona_id)
        ->where('inicio', '>=', $fecha_inicio)
        ->where('fin', '<', $fecha_fin)
        // ->whereBetween('fecha_vacacion', [$fecha_inicio, $fecha_fin])
        ->get();
        $suma_dias = 0;
        foreach ($fechas_dia as $key => $value) {
            # code...
            $suma_dias = $suma_dias + Tiempo::find($value->tiempo_id)->valor;
        }

        if (count($fechas_dia) > 0) {
            # Si se tiene vacaciones tomadas en esa Fecha
            // return $fechas_dia[0]->dias;
            return $suma_dias;
        } else {
            # Si no hay vacaciones tomadas en esa Fecha
            return 0;
        }
    }

    public static function setFechaVacacion($fecha)
    {
        if ($fecha) {
            return date("Y-m-d", strtotime($fecha));
        } else {
            return false;
        }
    }

    public static function setDiasTomados($inicio, $fin){
        $dias = Carbon::parse($inicio)->diffInDays(Carbon::parse($fin));
        // $domingos = [];
        $domingos = 0;
        $startDate = Carbon::parse($inicio)->next(Carbon::SATURDAY); // Obteniendo el primer Domingo.
        $endDate = Carbon::parse($fin);

        for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            // $domingos[] = $date->format('Y-m-d');
            $domingos = $domingos + 1;
        }
        return ($dias + 1) - $domingos;
    }

    public static function escala ($a, $m, $d){

        $a = 365*$a;
        $m = 30*$m;
        $d = $a + $m + $d;

        if ($d >= (10*365+1)) {
            $escala = 30;
        }
        elseif ($d >= ((5*365)+1)){
            $escala = 20;
        }
        elseif ($d >= ((1*365)+1)){
            $escala = 15;
        }
        else {
            $escala = 15;//No tiene derecho a Vacación si tiene menos de un año de antiguedad
        }
        return $escala;
    }
}
