<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitorAssignment extends Model
{
    protected $fillable = ['user_id' , 'qr_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
