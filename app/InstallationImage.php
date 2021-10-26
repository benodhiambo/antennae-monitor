<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstallationImage extends Model
{
    protected $fillable  = ['cell_id','image','sector_id','site_name'];
}
