<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{

    protected $fillable =
        [
            'qr_number','imsi','cell_id','installation_time'
        ];
}
