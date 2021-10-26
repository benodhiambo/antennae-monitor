<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{

    protected $primaryKey = 'cell_id';
    protected $keyType = 'string';

    protected $fillable = ['site_id','cell_id','sector_id','cell_name','mnc','status','technology','bcch_uarfcn_earfcn','bsci_psc_pci','heading',
        'pitch','roll'];

    //relationship
    public function site()
    {
        return $this->belongsTo(Site::class,'site_id','site_id');
    }

    public function monitorData()
    {
        return $this->hasMany(MonitorData::class, 'cell_id','cell_id');
    }

}
