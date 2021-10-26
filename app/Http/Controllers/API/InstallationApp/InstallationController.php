<?php
namespace App\Http\Controllers\API\InstallationApp;

use App\Alert;
use App\Http\Controllers\Controller;
use App\InstallationImage;
use App\Monitor;
use App\MonitorData;
use App\Site;
use App\Cell;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\ApiTraits;

class InstallationController extends Controller
{
    use ApiTraits;

    //display sitelist
    public function showSitelist()
    {
        $sites = Site::all();
        if($sites)
        {
            return response()->json(['status' => 'success','data'=>$sites],200);
        }else{
            return response()->json(['status' => 'failure','data'=>['message'=>'no data']],404);
        }
    }

    public function listSiteTechnologies(Request $request)
    {
        $request->validate([
            'site_id' => 'required',
        ]);
        $site_id = $request->get('site_id');
        $technologies = Cell::where('site_id', '=', $site_id)->groupBY('technology')->pluck('technology');
        if($technologies){
            return response()->json(['status' => 'success','data'=>$technologies],200);
        }else{
            return response()->json(['status' => 'failure','data'=>['message'=>'no data available']],404);
        }
    }

    public function listSectors(Request $request)
    {
        $request->validate([
            'technology' => 'required',
            'site_id' => 'required',
        ]);
        $cells = Cell::where('site_id','=',$request->get('site_id'))->where('technology' ,'=',$request->get('technology'))->select('sector_id','cell_id','cell_name')->get();
        if($cells){
            return response()->json(['status' => 'success','data'=>$cells],200);
        }else{
            return response()->json(['status' => 'failure','data'=>['message'=>'no data available']],404);
        }
    }

    public function validateCellID(Request $request)
    {
        $request->validate([
            'cell_id' => 'required',
        ]);
        if(MonitorData::where('cell_id' ,'=', $request->get('cell_id'))->exists()){
            return response()->json(['status' => 'success','data'=>['message'=>'match found']],200);
        }else{
            return response()->json(['status' => 'failure','data'=>['message'=>'no data available']],404);
        }
    }

    public function monitorRecords($cell_id)
    {
        $time =strtotime(Carbon::now()->format('H:i:s')) ;

        $monitor = MonitorData::where('cell_id',$cell_id)
            ->first();

        $m=Monitor::firstOrCreate(
            ['cell_id' => $monitor->cell_id],
            [   'qr_number' => $monitor->qr_number,
                'imsi' => $monitor->imsi,
                'installation_time' => $time
            ]);

        return $m;

    }

    public function uploadImage( Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'cell_id' => 'required',

        ]);

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $cell_id=$request->get('cell_id');
            $extension = $file->getClientOriginalExtension();
            $filename  = 'installation-image-' . time() . '.' . $extension;
            $path = $file->storeAs('public/installationImages', $filename);

            $image=InstallationImage::create([
                'cell_id' => $cell_id,
                'image' => $filename,

            ]);


            if($image){
                $this->monitorRecords($cell_id);
                return response()->json(['status'=> 'success','data'=>['message'=>'upload successful']],201);
            }else{
                return response()->json(['status' => 'failure','data'=>['message'=>'photo upload failed']],404);
            }
        }

    }
    public function getNearbySites(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required',
        ]);

        $lat = $request->get('lat');  //-4.03375
        $long = $request->get('long'); //39.6864
        $radius = 5;

         $sites =$this->nearbySites($lat,$long, $radius);
        // dd($sites);
         if ($sites){
             return response()->json(['status'=>'success','data'=> $sites],200);
         }
         else{
             return response()->json(['status'=>'success','data'=>['message'=> 'No sites found']],200);
         }
    }



}

