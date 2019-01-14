<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
  public $table = 't_sensors';
  protected $primaryKey = 'c_id';

  protected $fillable = ['c_name', 'c_type'];

  public function project() {
    return $this->belongsTo('App\Models\Project');
  }

  public function sensor_data() {
    return $this->hasMany('App\Models\Sensor_data');
  }
}
