<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = ['cell_id','qr_number','alert_type','value','status'];
}
