<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Sensor_data;
use App\Models\Sensor;
use Illuminate\Support\Collection;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Facades\Excel;

class WMSController extends Controller
{

  public function summary(){
    $parameter = request('parameter');

    if($parameter == null){
      $parameter = 'Temperature';
    }
    $daily_data = DB::select("SELECT AVG(sd.c_value) AS count, DATE(sd.c_time) AS date
                        FROM t_sensor_data sd
                        JOIN t_sensors s
                        ON s.c_id = sd.c_sensor
                        WHERE s.c_type = 'WMS' AND sd.c_sensed_parameter = '$parameter' AND YEAR(sd.c_time) = '2018'
                        GROUP BY DATE(sd.c_time);"
                    );
    $weekly_average = DB::select(
                          "SELECT AVG(sd.c_value)
                          FROM   t_sensor_data AS sd
                          WHERE  YEARWEEK(`c_time`, 1) = YEARWEEK(CURDATE(), 1)
                          AND c_sensed_parameter = '$parameter'"
                      );

    $lastDate = DB::table('t_sensor_data')
        ->orderBy('c_time', 'desc')
        ->select('c_time')
        ->limit(1)
        ->value('c_time');
    $lastDate = date("d F Y H:i:s", strtotime($lastDate));

    return view('wms.summary')
          ->with('parameter', json_encode($parameter))
          ->with('daily_data', json_encode($daily_data))
          ->with('lastDate', json_encode($lastDate));
  }

  public function chart()
  {
    //Get station and parameter from form
    $station = request('station');
    // $parameter = request('parameter');


    // if($parameter == null){
    //   $parameter = 'Temperature';
    // }

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

    $parametersArray = DB::table('t_sensor_data')
        ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
        ->where('t_sensors.c_type', '=', 'WMS')
        ->groupBy('c_sensed_parameter')
        ->distinct()
        ->pluck('c_sensed_parameter', 'c_sensed_parameter');

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


    //FOR LIVE
    // $last_temp = DB::table('t_sensor_data')
    //             ->where('c_sensed_parameter', '=', 'Temperature')
    //             ->orderBy('c_time', 'desc')
    //             ->select('c_value')
    //             ->limit(1)
    //             ->value('c_time')
    //             ;


    return view('wms.chart')
        ->with('stationsArray', $stationsArray)
        ->with('parametersArray', $parametersArray)
        ->with('station', json_encode($station,JSON_NUMERIC_CHECK))
        ->with('stationName', json_encode($stationName,JSON_NUMERIC_CHECK))
        // ->with('parameter', json_encode($parameter,JSON_NUMERIC_CHECK))
        // ->with('valueArray', json_encode($data,JSON_NUMERIC_CHECK))
        // ->with('dataFinal', json_encode($dataFinal,JSON_NUMERIC_CHECK))
        ->with('temp_dataFinal', json_encode($temp_dataFinal,JSON_NUMERIC_CHECK))
        ->with('pres_dataFinal', json_encode($pres_dataFinal,JSON_NUMERIC_CHECK))
        ->with('hum_dataFinal', json_encode($hum_dataFinal,JSON_NUMERIC_CHECK))
        ->with('rain_rate_dataFinal', json_encode($rain_rate_dataFinal,JSON_NUMERIC_CHECK))
        ->with('total_rain_dataFinal', json_encode($total_rain_dataFinal,JSON_NUMERIC_CHECK))
        ->with('sound_level_dataFinal', json_encode($sound_level_dataFinal,JSON_NUMERIC_CHECK))
        ->with('wind_dataFinal', json_encode($wind_dataFinal,JSON_NUMERIC_CHECK))
        ->with('dir_dataFinal', json_encode($dir_dataFinal,JSON_NUMERIC_CHECK))
        ->with('lastDate', json_encode($lastDate,JSON_NUMERIC_CHECK))
        // ->with('status', $status)
        ;
  }

  public static function wind(){
    $stationsArray= DB::table('t_sensor_data')
        ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
        ->where('t_sensors.c_type', '=', 'WMS')
        ->pluck('t_sensors.c_name', 't_sensors.c_id');

    $station = request('station');

    if($station == null){
      $station = 0;
    }

    $stationName = DB::table('t_sensors')
        ->where('c_id','=',$station)
        ->select('c_name')
        ->value('c_name');

    $total = DB::select(
            "SELECT SUM(count) as sum FROM
            (SELECT
                  CASE
                    WHEN (s2.c_value <11.25) THEN 'N'
                    WHEN (s2.c_value >=348.75 AND s2.c_value <11.25) THEN 'N'
                    WHEN (s2.c_value >=11.25 AND s2.c_value <33.75) THEN 'NNE'
                    WHEN (s2.c_value >=33.75 AND s2.c_value <56.25) THEN 'NE'
                    WHEN (s2.c_value >=56.25 AND s2.c_value <78.25) THEN 'ENE'
                    WHEN (s2.c_value >=78.25 AND s2.c_value <101.25) THEN 'E'
                    WHEN (s2.c_value >=101.25 AND s2.c_value <123.75) THEN 'ESE'
                    WHEN (s2.c_value >=123.75 AND s2.c_value <146.25) THEN 'SE'
                    WHEN (s2.c_value >=146.25 AND s2.c_value <168.75) THEN 'SSE'
                    WHEN (s2.c_value >=168.75 AND s2.c_value <191.25) THEN 'S'
                    WHEN (s2.c_value >=191.25 AND s2.c_value <213.75) THEN 'SSW'
                    WHEN (s2.c_value >=213.75 AND s2.c_value <236.25) THEN 'SW'
                    WHEN (s2.c_value >=236.25 AND s2.c_value <258.75) THEN 'WSW'
                    WHEN (s2.c_value >=258.75 AND s2.c_value <281.25) THEN 'W'
                    WHEN (s2.c_value >=281.25 AND s2.c_value <303.75) THEN 'WNW'
                    WHEN (s2.c_value >=303.75 AND s2.c_value <326.25) THEN 'NW'
                    WHEN (s2.c_value >=326.25 AND s2.c_value <348.75) THEN 'NNW'
                  END AS 'direction',
                  count(*) as count
                  FROM t_sensor_data s1
                  JOIN (SELECT *
                  FROM t_sensor_data
                  WHERE c_sensed_parameter = 'Wind direction') s2
                  ON s1.c_time = s2.c_time
                  WHERE s1.c_sensed_parameter = 'Wind speed'
                  AND s2.c_value != 359
                  GROUP BY direction) AS total"
    );

    $total = collect($total)->first();

    $wind_rose_1 = DB::select(
      "   SELECT
            CASE
              WHEN (s2.c_value <11.25) THEN 'N'
              WHEN (s2.c_value >=348.75 AND s2.c_value <11.25) THEN 'N'
              WHEN (s2.c_value >=11.25 AND s2.c_value <33.75) THEN 'NNE'
              WHEN (s2.c_value >=33.75 AND s2.c_value <56.25) THEN 'NE'
              WHEN (s2.c_value >=56.25 AND s2.c_value <78.25) THEN 'ENE'
              WHEN (s2.c_value >=78.25 AND s2.c_value <101.25) THEN 'E'
              WHEN (s2.c_value >=101.25 AND s2.c_value <123.75) THEN 'ESE'
              WHEN (s2.c_value >=123.75 AND s2.c_value <146.25) THEN 'SE'
              WHEN (s2.c_value >=146.25 AND s2.c_value <168.75) THEN 'SSE'
              WHEN (s2.c_value >=168.75 AND s2.c_value <191.25) THEN 'S'
              WHEN (s2.c_value >=191.25 AND s2.c_value <213.75) THEN 'SSW'
              WHEN (s2.c_value >=213.75 AND s2.c_value <236.25) THEN 'SW'
              WHEN (s2.c_value >=236.25 AND s2.c_value <258.75) THEN 'WSW'
              WHEN (s2.c_value >=258.75 AND s2.c_value <281.25) THEN 'W'
              WHEN (s2.c_value >=281.25 AND s2.c_value <303.75) THEN 'WNW'
              WHEN (s2.c_value >=303.75 AND s2.c_value <326.25) THEN 'NW'
              WHEN (s2.c_value >=326.25 AND s2.c_value <348.75) THEN 'NNW'
            END AS 'direction',
            count(*) as count
            FROM t_sensor_data s1
            JOIN (SELECT *
            FROM t_sensor_data
            WHERE c_sensed_parameter = 'Wind direction') s2
            ON s1.c_time = s2.c_time
            WHERE s1.c_sensed_parameter = 'Wind speed'
            AND s2.c_value != 359
            AND (s1.c_value >= 0 AND s1.c_value < 2)
            GROUP BY direction;"
    );

    $wind_rose_1 = collect($wind_rose_1)->pluck('count','direction')->toArray();

    $data_1 = array();
    foreach($wind_rose_1 as $key=>$val){
      $freq = round((($val/$total->sum)*100), 2);
      $data_1[] = array($key, $freq);
    }

    $wind_rose_2 = DB::select(
      "   SELECT
            CASE
              WHEN (s2.c_value <11.25) THEN 'N'
              WHEN (s2.c_value >=348.75 AND s2.c_value <11.25) THEN 'N'
              WHEN (s2.c_value >=11.25 AND s2.c_value <33.75) THEN 'NNE'
              WHEN (s2.c_value >=33.75 AND s2.c_value <56.25) THEN 'NE'
              WHEN (s2.c_value >=56.25 AND s2.c_value <78.25) THEN 'ENE'
              WHEN (s2.c_value >=78.25 AND s2.c_value <101.25) THEN 'E'
              WHEN (s2.c_value >=101.25 AND s2.c_value <123.75) THEN 'ESE'
              WHEN (s2.c_value >=123.75 AND s2.c_value <146.25) THEN 'SE'
              WHEN (s2.c_value >=146.25 AND s2.c_value <168.75) THEN 'SSE'
              WHEN (s2.c_value >=168.75 AND s2.c_value <191.25) THEN 'S'
              WHEN (s2.c_value >=191.25 AND s2.c_value <213.75) THEN 'SSW'
              WHEN (s2.c_value >=213.75 AND s2.c_value <236.25) THEN 'SW'
              WHEN (s2.c_value >=236.25 AND s2.c_value <258.75) THEN 'WSW'
              WHEN (s2.c_value >=258.75 AND s2.c_value <281.25) THEN 'W'
              WHEN (s2.c_value >=281.25 AND s2.c_value <303.75) THEN 'WNW'
              WHEN (s2.c_value >=303.75 AND s2.c_value <326.25) THEN 'NW'
              WHEN (s2.c_value >=326.25 AND s2.c_value <348.75) THEN 'NNW'
            END AS 'direction',
            count(*) as count
            FROM t_sensor_data s1
            JOIN (SELECT *
            FROM t_sensor_data
            WHERE c_sensed_parameter = 'Wind direction') s2
            ON s1.c_time = s2.c_time
            WHERE s1.c_sensed_parameter = 'Wind speed'
            AND s2.c_value != 359
            AND (s1.c_value >= 2 AND s1.c_value < 4)
            GROUP BY direction;"
    );

    $wind_rose_2 = collect($wind_rose_2)->pluck('count','direction')->toArray();

    $data_2 = array();
    foreach($wind_rose_2 as $key=>$val){
      $freq = round((($val/$total->sum)*100), 2);
      $data_2[] = array($key, $freq);
    }

    $wind_rose_3 = DB::select(
      "   SELECT
            CASE
              WHEN (s2.c_value <11.25) THEN 'N'
              WHEN (s2.c_value >=348.75 AND s2.c_value <11.25) THEN 'N'
              WHEN (s2.c_value >=11.25 AND s2.c_value <33.75) THEN 'NNE'
              WHEN (s2.c_value >=33.75 AND s2.c_value <56.25) THEN 'NE'
              WHEN (s2.c_value >=56.25 AND s2.c_value <78.25) THEN 'ENE'
              WHEN (s2.c_value >=78.25 AND s2.c_value <101.25) THEN 'E'
              WHEN (s2.c_value >=101.25 AND s2.c_value <123.75) THEN 'ESE'
              WHEN (s2.c_value >=123.75 AND s2.c_value <146.25) THEN 'SE'
              WHEN (s2.c_value >=146.25 AND s2.c_value <168.75) THEN 'SSE'
              WHEN (s2.c_value >=168.75 AND s2.c_value <191.25) THEN 'S'
              WHEN (s2.c_value >=191.25 AND s2.c_value <213.75) THEN 'SSW'
              WHEN (s2.c_value >=213.75 AND s2.c_value <236.25) THEN 'SW'
              WHEN (s2.c_value >=236.25 AND s2.c_value <258.75) THEN 'WSW'
              WHEN (s2.c_value >=258.75 AND s2.c_value <281.25) THEN 'W'
              WHEN (s2.c_value >=281.25 AND s2.c_value <303.75) THEN 'WNW'
              WHEN (s2.c_value >=303.75 AND s2.c_value <326.25) THEN 'NW'
              WHEN (s2.c_value >=326.25 AND s2.c_value <348.75) THEN 'NNW'
            END AS 'direction',
            count(*) as count
            FROM t_sensor_data s1
            JOIN (SELECT *
            FROM t_sensor_data
            WHERE c_sensed_parameter = 'Wind direction') s2
            ON s1.c_time = s2.c_time
            WHERE s1.c_sensed_parameter = 'Wind speed'
            AND s2.c_value != 359
            AND (s1.c_value >= 4 AND s1.c_value < 6)
            GROUP BY direction;"
    );

    $wind_rose_3 = collect($wind_rose_3)->pluck('count','direction')->toArray();

    $data_3 = array();
    foreach($wind_rose_3 as $key=>$val){
      $freq = round((($val/$total->sum)*100), 2);
      $data_3[] = array($key, $freq);
    }

    $wind_rose_4 = DB::select(
      "   SELECT
            CASE
              WHEN (s2.c_value <11.25) THEN 'N'
              WHEN (s2.c_value >=348.75 AND s2.c_value <11.25) THEN 'N'
              WHEN (s2.c_value >=11.25 AND s2.c_value <33.75) THEN 'NNE'
              WHEN (s2.c_value >=33.75 AND s2.c_value <56.25) THEN 'NE'
              WHEN (s2.c_value >=56.25 AND s2.c_value <78.25) THEN 'ENE'
              WHEN (s2.c_value >=78.25 AND s2.c_value <101.25) THEN 'E'
              WHEN (s2.c_value >=101.25 AND s2.c_value <123.75) THEN 'ESE'
              WHEN (s2.c_value >=123.75 AND s2.c_value <146.25) THEN 'SE'
              WHEN (s2.c_value >=146.25 AND s2.c_value <168.75) THEN 'SSE'
              WHEN (s2.c_value >=168.75 AND s2.c_value <191.25) THEN 'S'
              WHEN (s2.c_value >=191.25 AND s2.c_value <213.75) THEN 'SSW'
              WHEN (s2.c_value >=213.75 AND s2.c_value <236.25) THEN 'SW'
              WHEN (s2.c_value >=236.25 AND s2.c_value <258.75) THEN 'WSW'
              WHEN (s2.c_value >=258.75 AND s2.c_value <281.25) THEN 'W'
              WHEN (s2.c_value >=281.25 AND s2.c_value <303.75) THEN 'WNW'
              WHEN (s2.c_value >=303.75 AND s2.c_value <326.25) THEN 'NW'
              WHEN (s2.c_value >=326.25 AND s2.c_value <348.75) THEN 'NNW'
            END AS 'direction',
            count(*) as count
            FROM t_sensor_data s1
            JOIN (SELECT *
            FROM t_sensor_data
            WHERE c_sensed_parameter = 'Wind direction') s2
            ON s1.c_time = s2.c_time
            WHERE s1.c_sensed_parameter = 'Wind speed'
            AND s2.c_value != 359
            AND (s1.c_value >= 6)
            GROUP BY direction;"
    );

    $wind_rose_4 = collect($wind_rose_4)->pluck('count','direction')->toArray();

    $data_4 = array();
    foreach($wind_rose_4 as $key=>$val){
      $freq = round((($val/$total->sum)*100), 2);
      $data_4[] = array($key, $freq);
    }

    $lastDate = DB::table('t_sensor_data')
        ->orderBy('c_time', 'desc')
        ->select('c_time')
        ->limit(1)
        ->value('c_time');
    $lastDate = date("d F Y H:i:s", strtotime($lastDate));

    return view('wms.wind')
           ->with('stationsArray', $stationsArray)
           ->with('stationName', json_encode($stationName,JSON_NUMERIC_CHECK))
           ->with('data_1', json_encode($data_1,JSON_NUMERIC_CHECK))
           ->with('data_2', json_encode($data_2,JSON_NUMERIC_CHECK))
           ->with('data_3', json_encode($data_3,JSON_NUMERIC_CHECK))
           ->with('data_4', json_encode($data_4,JSON_NUMERIC_CHECK))
           ->with('lastDate', json_encode($lastDate,JSON_NUMERIC_CHECK))
           ->with('total', json_encode($total,JSON_NUMERIC_CHECK));
  }

  public static function tables()
  {
     //Display all sensor data
      $sensor_data = \App\Models\Sensor_data::all();

      // $status = APIController::getSensorData();

      return view('wms.tables', compact('sensor_data'))
          // ->with('status', $status)
          ;

  }

  public static function exportData(){

    return Excel::download(new \App\Exports\SensorDataExport, 'sensor_data.xlsx');

  }

  public static function exportTempData(){

    return Excel::download(new \App\Exports\SensorTempExport, 'temp_data.xlsx');

  }

  public static function exportPressureData(){

    return Excel::download(new \App\Exports\SensorPressureExport, 'pressure_data.xlsx');

  }

  public static function exportHumidityData(){

    return Excel::download(new \App\Exports\SensorHumidityExport, 'humidity_data.xlsx');

  }

  public static function exportRainRateData(){

    return Excel::download(new \App\Exports\SensorRainRateExport, 'rain_rate_data.xlsx');

  }

  public static function exportDailyRainfallData(){

    return Excel::download(new \App\Exports\SensorDailyRainfallExport, 'daily_rainfall_data.xlsx');

  }

  public static function exportSoundData(){

    return Excel::download(new \App\Exports\SensorSoundExport, 'sound_data.xlsx');

  }

  public static function exportWindData(){

    return Excel::download(new \App\Exports\SensorWindExport, 'wind_data.xlsx');

  }


}
