<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Cell;
use App\Monitor;
use App\MonitorData;
use Carbon\Carbon;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlertController extends Controller
{
    //display alert list
    public function showFullAlertslist()
    {
        $alertData = Alert::all();
        $cellData = $this->cellData();

        return view('alerts.alertlist', compact('cellData', 'alertData'));
    }

    //display monitors list
    public function showMonitorInstallations()
    {
        $instData = Monitor::all();
        $alertData = Alert::all();
        return view('alerts.monitor_inst', compact('instData', 'alertData'));
    }

    //display alert list
    public function showAlertStatusUpdate($alert_id)
    {
        $alertData = DB::table('alerts')->where('id', '=', $alert_id)->get();

        $cell = DB::table('alerts')->where('id', '=', $alert_id)->get(['cell_id']);
        $cell_id = json_decode(json_encode($cell), true);
        $cellData = DB::table('cells')->where('cell_id', '=', $cell_id)->get();

        $site = DB::table('cells')->where('cell_id', '=', $cell_id)->get(['site_id']);
        $site_id = json_decode(json_encode($site), true);

        $siteData = DB::table('sites')->where('site_id', '=', $site_id)->get();

        return view('alerts.update_alert_status', compact('alertData', 'cellData', 'siteData'));
    }

    public function updateStatus($alert_id, Request $request)
    {
        $request->validate([
            'status' => ['required'],
        ]);
        $alert = Alert::find($alert_id);
        $alert->status = $request->status;
        $update = $alert->save();
        
        return back();
    }

    public function cellData()
    {
        $cellIDs = DB::table('alerts')->distinct()->get(['cell_id']);

        $id_array = json_decode( json_encode($cellIDs), true);
        $cellData = DB::table('cells')->whereIn('cell_id', $id_array)->get();

        return $cellData;
    }

    //display alert list by types
    public function showAlertsByTypes()
    {
        $alertData = Alert::all();
        $cellData = $this->cellData();

        foreach ($cellData as $cell) {
            $cell_name = $this->editCellName($cell->cell_name);

            foreach ($alertData as $alert) {
                if($alert->cell_id == $cell->cell_id){

                    // add  cell name to alerts collection
                    $alert->cell_name = $cell_name;

                    // link alert to the cell threshold
                    $this->setThreshold($alert, $cell);
                }
            }
        }
        return view('alerts.alerts_types',compact('alertData'));
    }

    private function setThreshold($alert, $cell)
    {
        switch ($alert->alert_type) {
            case 'Heading':
                $alert->threshold = $cell->heading;
                break;
            
            case 'Pitch':
                $alert->threshold = $cell->pitch;
                break;
            
            case 'Roll':
                $alert->threshold = $cell->roll;
                break;
            
            case 'Low Voltage':
                $alert->threshold = '3.2';
                break;
            
            case 'Voltage Drop':
                $alert->threshold = '';
                break;
            
            case 'No Communication':
                $alert->threshold = '';
                break;
        }
    }
    
    //display alert list by status
    public function showAlertsByStatus()
    {
        $alertData = Alert::all();
        $cellData = $this->cellData();

        foreach ($cellData as $cell) {
            $cell_name = $this->editCellName($cell->cell_name);
            foreach ($alertData as $alert) {
                if($alert->cell_id == $cell->cell_id){
                    $alert->cell_name = $cell_name;
                    $this->setThreshold($alert, $cell);
                }
            }
        }
        return view('alerts.alerts_status',compact('alertData'));
    }

    private function editCellName($name)
    {
        $name_arr = explode("-", $name);
        $remove_id = array_splice($name_arr, 1);
        $raw_name = implode("-", $remove_id);
        $cell_name = str_replace('_', ' ', $raw_name);
        return $cell_name;
    }

    //display alert list per cell
    public function showCellAlertslist($cell_id)
    {
        $cellData = $this->cellData();
        $cellAlerts = DB::table('alerts')->where('cell_id', '=', $cell_id)->get();
        return view('alerts.cell_alerts',compact('cellData', 'alertData'));
    }

    //display alert list per site
    public function showSiteAlertslist($site_id)
    {
        return view('alerts.site_alerts');
    }
}