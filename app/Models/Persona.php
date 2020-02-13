<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombre', 'paterno', 'materno', 'codigo', 'cargo', 'dpto_seccion', 'haber_basico', 'fecha_ingreso'];
    // protected $guarded = ['id'];

    public function vacacion()
    {
        return $this->HasMany(Vacacion::class);
    }

    public static function setFecha($fecha_ingreso)
    {
        if ($fecha_ingreso) {
            return date("Y-m-d", strtotime($fecha_ingreso));
        } else {
            return false;
        }
    }
}
