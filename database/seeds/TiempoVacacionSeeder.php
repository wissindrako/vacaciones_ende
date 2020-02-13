<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tiempo;

class TiempoVacacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $valor = 0.5;
        $valores = [
            'Medio Día',
            'Todo el Día'
        ];
        foreach($valores as $key => $value){
            Tiempo::create([
                'valor' => $valor * ($key + 1),
                'descripcion' => $value
            ]);
        }
    }
}
