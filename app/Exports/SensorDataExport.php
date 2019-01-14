<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class SensorDataExport implements FromCollection
{
    public function collection()
    {
        return \App\Models\Sensor_data::all();;
    }
}
