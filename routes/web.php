<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//RAS2017 ROUTES

Route::get('/phpinfo',function () {return view('phpinfo');});

//
Route::get('/userregister',function(){
   return view('userregister');
});

Route::get('/user/register',function(){
   return view('userregister1');
});
Route::post('/user/register',array('uses'=>'UserRegistrationController@postRegister'));

//For testing
Route::get('/test',function(){
   return view('test');
});

//API
Route::post('/api','APIController@receive')->name('api');

Auth::routes();

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('sensors', 'SensorController');

Route::get('dashboard',
  function () {

  $status = App\Http\Controllers\APIController::getSensorData();

  return view('home')->with('status', $status);
  }
);

Route::get('dashboard/logs', 'DashboardController@logs')->name('dashboard.logs')->middleware('auth');
Route::get('dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

//WMS ROUTES
// Route::get('calendar', 'WMSController@calendar')->name('wms.calendar');
//SUMMARY
Route::get('wms', 'WMSController@summary')->name('wms.summary');

//CHARTS

Route::get('wms/chart', 'WMSController@chart')->name('wms.chart');
Route::get('wms/wind', 'WMSController@wind')->name('wms.wind');
Route::get('wms/live', 'LiveController@live')->name('wms.live');

//Live
Route::get('wms/live/lastTemp', 'LiveController@lastTemp')->name('wms.lastTemp');
Route::get('wms/live/lastPres', 'LiveController@lastPres')->name('wms.lastPres');
Route::get('wms/live/lastHum', 'LiveController@lastHum')->name('wms.lastHum');
Route::get('wms/live/lastRR', 'LiveController@lastRR')->name('wms.lastRR');
Route::get('wms/live/lastTR', 'LiveController@lastTR')->name('wms.lastTR');
Route::get('wms/live/lastSound', 'LiveController@lastSound')->name('wms.lastSound');
Route::get('wms/live/lastWS', 'LiveController@lastWS')->name('wms.lastWS');

//TABLES
Route::get('wms/tables', 'WMSController@tables')->name('wms.tables');

//MAP
Route::get('wms/rainfallMap', 'WMSController@rainfallMap')->name('wms.rainfallMap');
Route::get('wms/waterLevelMap', 'WMSController@waterLevelMap')->name('wms.waterLevelMap');

//EXPORT
Route::get('wms/export', 'WMSController@exportData')->name('wms.exportData');
Route::get('wms/exportTemp', 'WMSController@exportTempData')->name('wms.exportTempData');
Route::get('wms/exportPressure', 'WMSController@exportPressureData')->name('wms.exportPressureData');
Route::get('wms/exportHumidity', 'WMSController@exportHumidityData')->name('wms.exportHumidityData');
Route::get('wms/exportRainRate', 'WMSController@exportRainRateData')->name('wms.exportRainRateData');
Route::get('wms/exportDailyRainfall', 'WMSController@exportDailyRainfallData')->name('wms.exportDailyRainfallData');
Route::get('wms/exportSound', 'WMSController@exportSoundData')->name('wms.exportSoundData');
Route::get('wms/exportWind', 'WMSController@exportWindData')->name('wms.exportWindData');
Route::get('wms/exportWaterLevel', 'WMSController@exportWaterLevelData')->name('wms.exportWaterLevelData');


//DMS ROUTES
Route::get('dms', function () {return view('dms.home');} )->name('dms.home');


Route::get('/', 'HomeController@index')->name('home');

// Route::get('/home',
//   function () {
//
//   $status = App\Http\Controllers\APIController::getSensorData();
//
//   return view('home')->with('status', $status);
//   }
// );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
