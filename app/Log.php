<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable =  ['user_id','description', 'origin','type', 'result','level','token','ip' ,'user_agent',];
}
