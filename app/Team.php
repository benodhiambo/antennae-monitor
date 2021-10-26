<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['contractor_id','team_name','status'];

    public function contract()
    {
        return $this->belongsTo(Contractor::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
