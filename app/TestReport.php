<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    protected $fillable =
        [
            'qr_number', 'test_report','status', 'user_id'

        ];
}
