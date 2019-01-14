<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class APIController extends Controller
{
    // protected function addRoute(ControllerCollection $controllers){
    //     $controllers->post('/api', array($this, 'receive'));
    // }

    public static function receive(Request $request){

      //  $data = $request->input('str_data');
        $data = $request->all();

        $added = 0;

        $keys = array_keys($data);

        foreach($data as $key=>$field){
            //echo $key . ": " . $field . "\n";
            if($key == "dailyRain"){
                DB::table('t_sensor_data')
                ->insert([
                     'c_time' => DB::raw('NOW()'),
                     'c_sensor' => 0,
                     'c_sensed_parameter' => 'Daily rain',
                     'c_value' =>  $field
                   ]);
              $added += 1;
            }else if($key == "temperature"){
                DB::table('t_sensor_data')
                ->insert([
                     'c_time' => DB::raw('NOW()'),
                     'c_sensor' => 0,
                     'c_sensed_parameter' => 'Temperature' ,
                     'c_value' =>  $field
                   ]);
              $added += 1;
            }else if($key == "currentSpeed"){
              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => DB::raw('NOW()'),
                   'c_sensor' => 0,
                   'c_sensed_parameter' => 'Current speed' ,
                   'c_value' =>  $field
                 ]);
              $added += 1;
            }else if($key == "rainRate"){
              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => DB::raw('NOW()'),
                   'c_sensor' => 0,
                   'c_sensed_parameter' => 'Rain rate' ,
                   'c_value' =>  $field
                 ]);
              $added += 1;
            }else if($key == "currentDirection"){
              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => DB::raw('NOW()'),
                   'c_sensor' => 0,
                   'c_sensed_parameter' => 'Wind direction' ,
                   'c_value' =>  $field
                 ]);
              $added += 1;
            }else if($key == "humidity"){
              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => DB::raw('NOW()'),
                   'c_sensor' => 0,
                   'c_sensed_parameter' => 'Humidity' ,
                   'c_value' =>  $field
                 ]);
              $added += 1;
            }else if($key == "pressure"){
              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => DB::raw('NOW()'),
                   'c_sensor' => 0,
                   'c_sensed_parameter' => 'Pressure' ,
                   'c_value' =>  $field
                 ]);
              $added += 1;
            }else if($key == "windSpeed"){
              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => DB::raw('NOW()'),
                   'c_sensor' => 0,
                   'c_sensed_parameter' => 'Wind speed' ,
                   'c_value' =>  $field
                 ]);
              $added += 1;
            }else if($key == "decibel"){
              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => DB::raw('NOW()'),
                   'c_sensor' => 0,
                   'c_sensed_parameter' => 'Sound level' ,
                   'c_value' =>  $field
                 ]);
              $added += 1;
            }else if($key == "windDirection"){
              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => DB::raw('NOW()'),
                   'c_sensor' => 0,
                   'c_sensed_parameter' => 'Wind direction' ,
                   'c_value' =>  $field
                 ]);
              $added += 1;
            }
        }

        //*************
        //OLD CODE
        // Get latest date from the database
        // $lastDBdate = \App\Models\Sensor_data::orderBy('c_time', 'desc')
        //           ->limit(1)
        //           ->value('c_time');
        //
        // $lastDBdate = strtotime($lastDBdate);
        //
        // //Get latest parameters
        // $lastDBparameters = \App\Models\Sensor_data::
        // select('c_sensed_parameter')
        // ->where('c_time', '=', DB::raw('(SELECT max(c_time) FROM t_sensor_data)'))
        // ->get()
        // ->pluck('c_sensed_parameter')
        // ->toArray();
        //
        // foreach($data as $field){
        //   $jsonDate = strtotime($field['c_time']);
        //   $jsonParameter = $field['c_sensed_parameter'];
        //
        //     if($jsonDate > $lastDBdate) {
        //
        //       DB::table('t_sensor_data')
        //       ->insert([
        //            'c_time' => $field['c_time'],
        //            'c_sensor' => $field['c_sensor'],
        //            'c_sensed_parameter' => $field['c_sensed_parameter'] ,
        //            'c_value' =>  $field['c_value']
        //          ]);
        //
        //       $added += 1;
        //     } else if(($jsonDate == $lastDBdate) & !in_array($jsonParameter, $lastDBparameters)){
        //             DB::table('t_sensor_data')
        //             ->insert([
        //                  'c_time' => $field['c_time'],
        //                  'c_sensor' => $field['c_sensor'],
        //                  'c_sensed_parameter' => $field['c_sensed_parameter'] ,
        //                  'c_value' =>  $field['c_value']
        //                ]);
        //
        //     } // else if
        // } //foreach
        //*************
        //OLD CODE

        //VAR_DUMP($keys);
        //VAR_DUMP($data);
        echo $added . " data added. \n";
    }

}
