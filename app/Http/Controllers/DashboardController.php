<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;
        return view('dashboard', compact('username'));
    }

    public function fetchData()
    {
        $data = DB::table('tb_sensor_real')
            ->selectRaw('
                AVG(s_temp1) as avg_temp1,
                AVG(s_temp2) as avg_temp2,
                AVG(s_temp3) as avg_temp3,
                AVG(s_temp4) as avg_temp4,
                AVG(s_humid1) as avg_humid1,
                AVG(s_humid2) as avg_humid2,
                AVG(s_humid3) as avg_humid3,
                AVG(s_humid4) as avg_humid4,
                AVG(s_lux1) as avg_lux1,
                AVG(s_lux4) as avg_lux4,
                AVG(s_co2) as avg_co2
            ')
            ->first();

        $response = [
            'avg_temperature' => (($data->avg_temp1 + $data->avg_temp2 + $data->avg_temp3 + $data->avg_temp4) / 4) / 10,
            'avg_humidity' => (($data->avg_humid1 + $data->avg_humid2 + $data->avg_humid3 + $data->avg_humid4) / 4) / 10,
            'avg_lux' => ($data->avg_lux1 + $data->avg_lux4) / 2,
            'avg_co2' => $data->avg_co2 ?? 0
        ];

        return response()->json($response);
    }

    public function getChartData()
    {
        $result = DB::table('tb_sensor_real')
            ->orderBy('terminal_time', 'desc')
            ->limit(50)
            ->get();

        $data = [];
        $time = [];
        $temperature = [];
        $humidity = [];
        $lux = [];
        $co2 = [];

        foreach ($result as $row) {
            $time[] = $row->terminal_time;
            $temperature[] = (($row->s_temp1 + $row->s_temp2 + $row->s_temp3 + $row->s_temp4) / 4) / 10;
            $humidity[] = (($row->s_humid1 + $row->s_humid2 + $row->s_humid3 + $row->s_humid4) / 4) / 10;
            $lux[] = ($row->s_lux1 + $row->s_lux4) / 2;
            $co2[] = $row->s_co2;
        }

        $data['labels'] = array_reverse($time);
        $data['temperature'] = array_reverse($temperature);
        $data['humidity'] = array_reverse($humidity);
        $data['lux'] = array_reverse($lux);
        $data['co2'] = array_reverse($co2);

        return response()->json($data);
    }
}
