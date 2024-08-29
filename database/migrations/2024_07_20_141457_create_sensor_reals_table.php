<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_sensor_real', function (Blueprint $table) {
            $table->id();
            $table->dateTime('terminal_time');
            $table->float('s_humid1');
            $table->float('s_temp1');
            $table->float('s_lux1');
            $table->float('s_humid2');
            $table->float('s_temp2');
            $table->float('s_humid3');
            $table->float('s_temp3');
            $table->float('s_humid4');
            $table->float('s_temp4');
            $table->float('s_lux4');
            $table->float('s_co2');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jangan hapus tabel jika sudah ada data di dalamnya
        // Schema::dropIfExists('tb_sensor_real');
    }
};
