<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiempo extends Model
{
    protected $table = 'tiempo';
    public $timestamps = false;

    public function vacacion()
    {
        return $this->HasMany(Vacacion::class);
    }

}
