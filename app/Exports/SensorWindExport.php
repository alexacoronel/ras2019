<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class SensorWindExport implements FromQuery
{
    use Exportable;

    public function query()
    {
      return \App\Models\Sensor_data::query()->where('c_sensed_parameter', 'wind speed');
    }
}
