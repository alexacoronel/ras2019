<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Sensor_data;
use App\Models\Sensor;
use Illuminate\Support\Collection;

class LiveController extends Controller
{
  public function live()
  {
    $station = request('station');

    if($station == null){
      $station = 0;
    }

    //   temp: C
    //   pressure: pascal
    //   humidity: %
    //   rain intensity: db
    //   wind speed: km/h
    //   direction: degrees

    //Temperature
    $temp_data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', 'Temperature']
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();
    //Get first and last keys of $data
    $temp_keys = array_keys($temp_data);
    $temp_last_key = end($temp_keys);
    reset($temp_data);
    $temp_first_key = key($temp_data);
    //Get chart data with y in UNIX time format [x,y]
    $temp_dataFinal = array();
    foreach ($temp_data as $key => $val) {
      $temp_dataFinal[] = array(strtotime($key)*1000, $val);
    }

    //Pressure
    $pres_data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', 'Pressure']
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();
    //Get first and last keys of $data
    $pres_keys = array_keys($pres_data);
    $pres_last_key = end($pres_keys);
    reset($temp_data);
    $pres_first_key = key($pres_data);
    //Get chart data with y in UNIX time format [x,y]
    $pres_dataFinal = array();
    foreach ($pres_data as $key => $val) {
      $pres_dataFinal[] = array(strtotime($key)*1000, $val);
    }


    //Humidity
    $hum_data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', 'Humidity']
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();
    //Get first and last keys of $data
    $hum_keys = array_keys($hum_data);
    $hum_last_key = end($hum_keys);
    reset($hum_data);
    $hum_first_key = key($hum_data);
    //Get chart data with y in UNIX time format [x,y]
    $hum_dataFinal = array();
    foreach ($hum_data as $key => $val) {
      $hum_dataFinal[] = array(strtotime($key)*1000, $val);
    }

    //Rain rate
    $rain_rate_data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', 'Rain rate']
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();
    //Get first and last keys of $data
    $rain_rate_keys = array_keys($rain_rate_data);
    $rain_rate_last_key = end($rain_rate_keys);
    reset($rain_rate_data);
    $rain_rate_first_key = key($rain_rate_data);
    //Get chart data with y in UNIX time format [x,y]
    $rain_rate_dataFinal = array();
    foreach ($rain_rate_data as $key => $val) {
      $rain_rate_dataFinal[] = array(strtotime($key)*1000, $val);
    }

    //Total rain
    $total_rain_data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', 'Total rain']
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();
    //Get first and last keys of $data
    $total_rain_keys = array_keys($total_rain_data);
    $total_rain_last_key = end($total_rain_keys);
    reset($total_rain_data);
    $total_rain_first_key = key($total_rain_data);
    //Get chart data with y in UNIX time format [x,y]
    $total_rain_dataFinal = array();
    foreach ($total_rain_data as $key => $val) {
      $total_rain_dataFinal[] = array(strtotime($key)*1000, $val);
    }

    //Sound level
    $sound_level_data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', 'Sound level']
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();
    //Get first and last keys of $data
    $sound_level_keys = array_keys($sound_level_data);
    $sound_level_last_key = end($sound_level_keys);
    reset($sound_level_data);
    $sound_level_first_key = key($sound_level_data);
    //Get chart data with y in UNIX time format [x,y]
    $sound_level_dataFinal = array();
    foreach ($sound_level_data as $key => $val) {
      $sound_level_dataFinal[] = array(strtotime($key)*1000, $val);
    }

    //Wind speed
    $wind_data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', 'Wind speed']
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();

    //Get first and last keys of $data
    $wind_keys = array_keys($wind_data);
    $wind_last_key = end($wind_keys);

    reset($wind_data);
    $wind_first_key = key($wind_data);

    //Get chart data with y in UNIX time format [x,y]
    $wind_dataFinal = array();
    foreach ($wind_data as $key => $val) {
      $wind_dataFinal[] = array(strtotime($key)*1000, $val);
    }

    //Wind direction
    $dir_data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', 'Wind direction']
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();

    //Get first and last keys of $data
    $dir_keys = array_keys($dir_data);
    $dir_last_key = end($dir_keys);

    reset($dir_data);
    $dir_first_key = key($dir_data);

    //Get chart data with y in UNIX time format [x,y]
    $dir_dataFinal = array();
    foreach ($dir_data as $key => $val) {
      $dir_dataFinal[] = array(strtotime($key)*1000, $val);
    }

    //List stations and parameters
    //pluck(key, value)
    //Form-> name=value value=key
    $stationsArray= DB::table('t_sensor_data')
        ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
        ->where('t_sensors.c_type', '=', 'WMS')
        ->pluck('t_sensors.c_name', 't_sensors.c_id');

    $stationName = DB::table('t_sensors')
        ->where('c_id','=',$station)
        ->select('c_name')
        ->value('c_name');

    //Get last data's date
    $lastDate = DB::table('t_sensor_data')
        ->orderBy('c_time', 'desc')
        ->select('c_time')
        ->limit(1)
        ->value('c_time');
    $lastDate = date("d F Y H:i:s", strtotime($lastDate));

    $date = date('Y-m-d H:i:s');

    return view('wms.live')
        ->with('stationsArray', $stationsArray)
        ->with('station', json_encode($station,JSON_NUMERIC_CHECK))
        ->with('stationName', json_encode($stationName,JSON_NUMERIC_CHECK))
        ->with('temp_dataFinal', json_encode($temp_dataFinal,JSON_NUMERIC_CHECK))
        ->with('pres_dataFinal', json_encode($pres_dataFinal,JSON_NUMERIC_CHECK))
        ->with('hum_dataFinal', json_encode($hum_dataFinal,JSON_NUMERIC_CHECK))
        ->with('rain_rate_dataFinal', json_encode($rain_rate_dataFinal,JSON_NUMERIC_CHECK))
        ->with('total_rain_dataFinal', json_encode($total_rain_dataFinal,JSON_NUMERIC_CHECK))
        ->with('sound_level_dataFinal', json_encode($sound_level_dataFinal,JSON_NUMERIC_CHECK))
        ->with('wind_dataFinal', json_encode($wind_dataFinal,JSON_NUMERIC_CHECK))
        ->with('dir_dataFinal', json_encode($dir_dataFinal,JSON_NUMERIC_CHECK))
        ->with('lastDate', json_encode($lastDate,JSON_NUMERIC_CHECK))
        ->with('date', json_encode($date,JSON_NUMERIC_CHECK))
        ;
  }

  public function lastTemp(){
    $last_temp = DB::table('t_sensor_data')
                ->where('c_sensed_parameter', '=', 'Temperature')
                ->orderBy('c_time', 'desc')
                ->select('c_time','c_value')
                ->limit(1)
                ->get('c_value','c_time');

    // $last_temp_final = array();
    //
    // foreach ($last_temp as $key => $val) {
    //   $last_temp_final = array(
    //     "time" => strtotime($key)*1000,
    //     "value" => $val);
    // }

    return view('wms.lastTemp')
          // >with('last_temp_final', json_encode($last_temp_final,JSON_NUMERIC_CHECK))
          //->with('last_temp', json_encode($last_temp,JSON_NUMERIC_CHECK));
          ->with('last_temp', json_encode($last_temp,JSON_NUMERIC_CHECK));

  }

  public function lastPres(){
    $last_pres = DB::table('t_sensor_data')
                ->where('c_sensed_parameter', '=', 'Pressure')
                ->orderBy('c_time', 'desc')
                ->select('c_time','c_value')
                ->limit(1)
                ->get('c_value','c_time');

    return view('wms.lastPres')
          ->with('last_pres', json_encode($last_pres,JSON_NUMERIC_CHECK));

  }

  public function lastHum(){
    $last_hum = DB::table('t_sensor_data')
                ->where('c_sensed_parameter', '=', 'Humidity')
                ->orderBy('c_time', 'desc')
                ->select('c_time','c_value')
                ->limit(1)
                ->get('c_value','c_time');

    return view('wms.lastHum')
          ->with('last_hum', json_encode($last_hum,JSON_NUMERIC_CHECK));

  }

  public function lastRR(){
    $last_RR = DB::table('t_sensor_data')
                ->where('c_sensed_parameter', '=', 'Rain rate')
                ->orderBy('c_time', 'desc')
                ->select('c_time','c_value')
                ->limit(1)
                ->get('c_value','c_time');

    return view('wms.lastRR')
          ->with('last_RR', json_encode($last_RR,JSON_NUMERIC_CHECK));

  }

  public function lastTR(){
    $last_TR = DB::table('t_sensor_data')
                ->where('c_sensed_parameter', '=', 'Total rain')
                ->orderBy('c_time', 'desc')
                ->select('c_time','c_value')
                ->limit(1)
                ->get('c_value','c_time');

    return view('wms.lastTR')
          ->with('last_TR', json_encode($last_TR,JSON_NUMERIC_CHECK));
  }

  public function lastSound(){
    $last_sound = DB::table('t_sensor_data')
                ->where('c_sensed_parameter', '=', 'Sound level')
                ->orderBy('c_time', 'desc')
                ->select('c_time','c_value')
                ->limit(1)
                ->get('c_value','c_time');

    return view('wms.lastSound')
          ->with('last_sound', json_encode($last_sound,JSON_NUMERIC_CHECK));
  }

  public function lastWS(){
    $last_WS = DB::table('t_sensor_data')
                ->where('c_sensed_parameter', '=', 'Wind speed')
                ->orderBy('c_time', 'desc')
                ->select('c_time','c_value')
                ->limit(1)
                ->get('c_value','c_time');

    return view('wms.lastWS')
          ->with('last_WS', json_encode($last_WS,JSON_NUMERIC_CHECK));
  }
}
