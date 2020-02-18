<?php

use Illuminate\Database\Seeder;
use App\Models\Feriado;
use Carbon\Carbon;

class TablaFeriadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fechas = [
            '2015-01-01',
            '2015-01-22',
            '2015-01-24'
        ];
        for ($i=0; $i < 6; $i++) {
            foreach($fechas as $value){
                $nueva_fecha = strtotime('+'.($i).' year', strtotime($value));
                $nueva_fecha = date('Y-m-d', $nueva_fecha);
                Feriado::create([
                    'fecha' => $nueva_fecha,
                ]);
            }
        }
    }
}
