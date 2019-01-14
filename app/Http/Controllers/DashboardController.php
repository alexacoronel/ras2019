<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Artisan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\APIController;
use Session;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\Models\User::all();
        $sensors = \App\Models\Sensor::all();
        $sensor_data = \App\Models\Sensor_data::all();

        $lastDateUser = DB::table('users')
            ->orderBy('created_at', 'desc')
            ->select('created_at')
            ->limit(1)
            ->value('created_at');
        $lastDateUser = date("d F Y H:i:s", strtotime($lastDateUser));

        $lastDateSensor = DB::table('t_sensors')
            ->orderBy('created_at', 'desc')
            ->select('created_at')
            ->limit(1)
            ->value('created_at');
        $lastDateSensor = date("d F Y H:i:s", strtotime($lastDateSensor));

        return view('dashboard')
              ->with('users', $users)
              ->with('sensor_data', $sensor_data)
              ->with('sensors', $sensors)
              ->with('lastDateUser', $lastDateUser)
              ->with('lastDateSensor', $lastDateSensor);
    }

    public function logs(){

      $activities = Activity::all();

      return view('logs')
             ->with('activities', $activities);
    }

}
