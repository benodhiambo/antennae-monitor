<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitorData extends Model
{
    public function cells()
    {
        return $this->belongsTo(Cell::class);
    }

    protected $fillable =
        [
            'qr_number', 'firmware_version', 'payload_type', 'switch_wake_up', 'mag_wake_up', 'new_attach_flag', 'calibrate_flag',
            'temperature', 'voltage', 'heading', 'pitch', 'roll',
            'accel_x', 'accel_y', 'accel_z', 'mag_x', 'mag_y', 'mag_z', 'mag_x_min', 'mag_y_min', 'mag_z_min', 'mag_x_max', 'mag_y_max',
            'mag_z_max', 'lat', 'long', 'bssid1', 'wifi_rssi1', 'bssid2', 'wifi_rssi2', 'bssid3', 'wifi_rssi3', 'csq', 'snr', 'rsrq', 'cell_id', 'pci', 'imsi', 'imei', 'sleep_duration',
            'bc95g_ok,', 'esp_ok', 'bidset_ok', 'tmp75_ok', 'lis3dh_ok', 'lis3mdl_ok', 'server_ip', 'server_port', 'sensor_ip', 'sensor_port'
        ];
}
