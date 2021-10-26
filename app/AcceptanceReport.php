<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcceptanceReport extends Model
{
    protected $fillable = [
        'installation_report_id' ,'comment','status','acceptance_form'
    ];
}
