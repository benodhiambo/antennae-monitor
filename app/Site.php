<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = 'site_id';
    protected $keyType = 'string';


    protected $fillable = ['node_id','site_id','site_name','lac','mcc','vendor','lat','long'];

    //relationship
    public function cells()
    {
       return $this->hasMany(Cell::class,'site_id','site_id');
    }
}
