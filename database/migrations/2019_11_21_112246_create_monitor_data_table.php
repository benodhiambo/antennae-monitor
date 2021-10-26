<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_data', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('qr_number');
            $table->string('firmware_version');
            $table->string('payload_type');
            $table->string( 'switch_wake_up');
            $table->string( 'mag_wake_up');
            $table->string('new_attach_flag');
            $table->string('calibrate_flag');
            $table->string('temperature');
            $table->string('voltage');
            $table->float('heading');
            $table->float('pitch');
            $table->float('roll');
            $table->string('accel_x');
            $table->string('accel_y');
            $table->string('accel_z');
            $table->string('mag_x');
            $table->string('mag_y');
            $table->string('mag_z');
            $table->string('mag_x_min');
            $table->string('mag_y_min');
            $table->string('mag_z_min');
            $table->string('mag_x_max');
            $table->string('mag_y_max');
            $table->string('mag_z_max');
            $table->string('lat');
            $table->string('long');
            $table->string('bssid1');
            $table->string('wifi_rssi1');
            $table->string('bssid2');
            $table->string('wifi_rssi2');
            $table->string('bssid3');
            $table->string('wifi_rssi3');
            $table->string('csq');
            $table->string('snr');
            $table->string('rsrq');
            $table->string('cell_id');
            $table->string('pci');
            $table->string('imsi');
            $table->string('imei');
            $table->string('sleep_duration');
            $table->string('bc95g_ok');
            $table->string('esp_ok');
            $table->string('bidset_ok');
            $table->string('tmp75_ok');
            $table->string('lis3dh_ok');
            $table->string('lis3mdl_ok');
            $table->string('server_ip');
            $table->string('server_port');
            $table->string('sensor_ip');
            $table->string('sensor_port');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitor_data');
    }
}
