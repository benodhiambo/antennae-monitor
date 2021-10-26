<?php


namespace App\Http\Traits;
use App\Site;
use Illuminate\Support\Facades\DB;

trait ApiTraits
{
    //geofencing function -get nearby sites

    public function nearbySites($lat, $long,$radius)
    {

        $query = DB::select("SELECT * FROM
        (SELECT site_id,site_name,lat,long,vendor, (6371 * acos(cos(radians($lat)) * cos(radians(lat)) *
            cos(radians(long) - radians($long)) +
            sin(radians($lat)) * sin(radians(lat))))
   AS distance
   FROM public.sites) AS distances
WHERE distance < $radius");

        return $query;

    }

}



