<?php

namespace App\Http\Controllers\API\InstallationApp;

use App\Http\Controllers\Controller;
use App\Jobs\SaveInstallationReportJob;
use App\Jobs\SaveTestReportJob;
use App\Jobs\SendReportEmailJob;
use App\User;
use App\Cell;
use App\MonitorData;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InstallationReportController extends Controller
{
    public function sendMail(Request $request, $id )
    {

        $user = User::where('id', '=', $id)->first();
        $data = [
            'site_name' => $request->get('site_name'),
            'site_id' => $request->get('site_id'),
            'technology' => $request->get('technology'),
            'cell_id' => $request->get('cell_id'),
            'name' => $user->name,
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role->role_name,
        ];

        $data['report_id'] =rand(100000, 900000).'ADC';

        $t =time();
        $data['date']=date("Y-m-d",$t);
        $data['time']=date('H:i:s',$t);
        $count =$data['cell_id'] ;
        $data['sectors_count'] = count($count);

        $readings= Cell::with('monitorData')->whereIn('cell_id',$request->get('cell_id'))
            ->get()->toArray();
      //  dd($readings[0]['monitor_data'][0]['heading']);





        //generate pdf and save to directory

        $pdf = PDF::loadView('mails.installation_report', compact('data','readings'));
        $filename = $data['site_name']."_".$data['technology'] . '_InstallationReport.pdf';
        Storage::put('public/InstallationReport/' . $filename, $pdf->output());
        $uri = storage_path('app/public/InstallationReport/'.$filename);
        $subject= 'Installation Report';


        $savetodbJob = (new SaveInstallationReportJob($data))->delay(Carbon::now()->addSeconds(2));
        dispatch($savetodbJob );

        //send report to email
        $emailJob = (new SendReportEmailJob($uri,$subject))->delay(Carbon::now()->addSeconds(3));
        dispatch($emailJob);


        return response()->json(['status'=>'success', 'data'=>$data],200);
    }
}
