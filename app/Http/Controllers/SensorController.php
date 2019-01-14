<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])
            ->except('index', 'show');
    }

    public function index()
    {
        $sensors = \App\Models\Sensor::all();

        return view('sensors.index')->with('sensors', $sensors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       $projects = DB::table('t_projects')->pluck('c_name', 'c_name');

       return view('sensors.create', compact('projects'));
     }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       $this->validate($request, [
           'c_type'=>'required',
           'c_name' =>'required | unique:t_sensors',
           ]);

       $type = $request['c_type'];
       $name = $request['c_name'];

       $sensor = \App\Models\Sensor::create(['c_type'=>$type, 'c_name' => $name]);

       activity()
       ->log('Sensor ' . $name . ' for ' . $type . ' created');

       return redirect()->route('sensors.index')
           ->with('flash_message', 'Sensor
            '. $sensor->c_name.' created successfully.');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       $sensor = \App\Models\Sensor::findOrFail($id);

       return view ('sensors.show', compact('sensor'));
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       $sensor = \App\Models\Sensor::findOrFail($id);
       $projects = DB::table('t_projects')->pluck('c_name', 'c_name');

       return view('sensors.edit', compact('sensor'), compact('projects'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
       $this->validate($request, [
             'type'=>'required',
             'name' =>'required',
         ]);

       $sensor = \App\Models\Sensor::findOrFail($id);
       $sensor->c_type = $request->input('type');
       $sensor->c_name = $request->input('name');
       $sensor->save();

       activity()
       ->log('Sensor ' . $sensor->c_type . ' for ' . $sensor->c_type . ' updated');

       return redirect()->route('sensors.index',$sensor->c_id)
           ->with('flash_message','Sensor '. $sensor->c_name.' updated successfully.');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       $sensor = \App\Models\Sensor::findOrFail($id);
       $sensor->delete();

       activity()
       ->log('Sensor ' . $sensor->c_name . ' deleted');

       return redirect()->route('sensors.index')
           ->with('flash_message',
            'Sensor successfully deleted');
   }
}
