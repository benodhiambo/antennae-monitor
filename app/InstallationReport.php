<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstallationReport extends Model
{

    protected $fillable =
        [
            'site_name','technology', 'installation_report','status', 'user_id'

            ];
}
