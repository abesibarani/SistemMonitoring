<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    // Menampilkan halaman utama ruang tengah
    public function index()
    {
        return view('ruangtengah');
    }

    // Mengambil data sensor dari database
    public function getMainRoomData()
    {
        // Ambil data sensor suhu, kelembapan, dan cahaya
        $suhuData = DB::table('tb_sensor_real')
            ->select('terminal_time', 's_temp4')
            ->orderBy('terminal_time', 'desc')
            ->limit(10)
            ->get();

        $kelembapanData = DB::table('tb_sensor_real')
            ->select('terminal_time', 's_humid4')
            ->orderBy('terminal_time', 'desc')
            ->limit(10)
            ->get();

        $cahayaData = DB::table('tb_sensor_real')
            ->select('terminal_time', 's_lux4')
            ->orderBy('terminal_time', 'desc')
            ->limit(10)
            ->get();

        // Proses data suhu
        $suhuProcessedData = $suhuData->map(function ($data) {
            return [
                'terminal_time' => $data->terminal_time,
                'data' => round($data->s_temp4 / 10, 1)
            ];
        });

        // Proses data kelembapan
        $kelembapanProcessedData = $kelembapanData->map(function ($data) {
            return [
                'terminal_time' => $data->terminal_time,
                'data' => round($data->s_humid4 / 10, 1)
            ];
        });

        // Siapkan respons JSON
        $response = [
            'suhu' => [
                'terminal_time' => $suhuProcessedData->pluck('terminal_time'),
                'data' => $suhuProcessedData->pluck('data')
            ],
            'kelembapan' => [
                'terminal_time' => $kelembapanProcessedData->pluck('terminal_time'),
                'data' => $kelembapanProcessedData->pluck('data')
            ],
            'cahaya' => [
                'terminal_time' => $cahayaData->pluck('terminal_time'),
                'data' => $cahayaData->pluck('s_lux4')
            ]
        ];

        return response()->json($response);
    }

    public function outdoor()
    {
        return view('outdoor');
    }

    // Method untuk mendapatkan data sensor outdoor
    public function getOutdoorData()
    {
        $suhuData = DB::table('tb_sensor_real')->orderBy('terminal_time', 'desc')->limit(10)->get(['terminal_time', 's_temp1']);
        $kelembapanData = DB::table('tb_sensor_real')->orderBy('terminal_time', 'desc')->limit(10)->get(['terminal_time', 's_humid1']);
        $cahayaData = DB::table('tb_sensor_real')->orderBy('terminal_time', 'desc')->limit(10)->get(['terminal_time', 's_lux1']);

        $suhuProcessedData = $suhuData->map(function ($item) {
            return [
                'terminal_time' => $item->terminal_time,
                'data' => round($item->s_temp1 / 10, 1)
            ];
        });

        $kelembapanProcessedData = $kelembapanData->map(function ($item) {
            return [
                'terminal_time' => $item->terminal_time,
                'data' => round($item->s_humid1 / 10, 1)
            ];
        });

        $response = [
            'suhu' => [
                'terminal_time' => $suhuProcessedData->pluck('terminal_time'),
                'data' => $suhuProcessedData->pluck('data')
            ],
            'kelembapan' => [
                'terminal_time' => $kelembapanProcessedData->pluck('terminal_time'),
                'data' => $kelembapanProcessedData->pluck('data')
            ],
            'cahaya' => [
                'terminal_time' => $cahayaData->pluck('terminal_time'),
                'data' => $cahayaData->pluck('s_lux1')
            ]
        ];

        return response()->json($response);
    }

    public function restroom()
    {
        return view('restroom');
    }

    public function getRestroomData()
    {
        $suhuData = DB::table('tb_sensor_real')
            ->select('terminal_time', DB::raw('ROUND(s_temp2 / 10, 1) as data'))
            ->orderBy('terminal_time', 'desc')
            ->limit(10)
            ->get();

        $kelembapanData = DB::table('tb_sensor_real')
            ->select('terminal_time', DB::raw('ROUND(s_humid2 / 10, 1) as data'))
            ->orderBy('terminal_time', 'desc')
            ->limit(10)
            ->get();

        $response = [
            'suhu' => [
                'terminal_time' => $suhuData->pluck('terminal_time'),
                'data' => $suhuData->pluck('data'),
            ],
            'kelembapan' => [
                'terminal_time' => $kelembapanData->pluck('terminal_time'),
                'data' => $kelembapanData->pluck('data'),
            ],
        ];

        return response()->json($response);
    }

    public function pantry()
    {
        return view('pantry');
    }

    public function getPantryData()
    {
        // Fetch data for each sensor
        $suhuData = DB::table('tb_sensor_real')
            ->select('terminal_time', 's_temp3')
            ->orderBy('terminal_time', 'desc')
            ->limit(10)
            ->get();

        $kelembapanData = DB::table('tb_sensor_real')
            ->select('terminal_time', 's_humid3')
            ->orderBy('terminal_time', 'desc')
            ->limit(10)
            ->get();

        $co2Data = DB::table('tb_sensor_real')
            ->select('terminal_time', 's_co2')
            ->orderBy('terminal_time', 'desc')
            ->limit(10)
            ->get();

        // Process temperature (suhu) data
        $suhuProcessedData = $suhuData->map(function ($data) {
            return [
                'terminal_time' => $data->terminal_time,
                'data' => round($data->s_temp3 / 10, 1) // Divide by 10 and round to 1 decimal place
            ];
        });

        // Process humidity (kelembapan) data
        $kelembapanProcessedData = $kelembapanData->map(function ($data) {
            return [
                'terminal_time' => $data->terminal_time,
                'data' => round($data->s_humid3 / 10, 1) // Divide by 10 and round to 1 decimal place
            ];
        });

        // Siapkan respons JSON
        $response = [
            'suhu' => [
                'terminal_time' => $suhuProcessedData->pluck('terminal_time'),
                'data' => $suhuProcessedData->pluck('data')
            ],
            'kelembapan' => [
                'terminal_time' => $kelembapanProcessedData->pluck('terminal_time'),
                'data' => $kelembapanProcessedData->pluck('data')
            ],
            'co2' => [
                'terminal_time' => $co2Data->pluck('terminal_time'),
                'data' => $co2Data->pluck('s_co2')
            ]
        ];

        return response()->json($response);
    }
}
