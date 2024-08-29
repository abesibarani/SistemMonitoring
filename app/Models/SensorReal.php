<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorReal extends Model
{
    protected $table = 'tb_sensor_real';
    protected $fillable = [
        'terminal_time', 's_humid1', 's_temp1', 's_lux1',
        's_humid2', 's_temp2', 's_humid3', 's_temp3',
        's_humid4', 's_temp4', 's_lux4', 's_co2', 'created_at'
    ];
    public $timestamps = false;
}
