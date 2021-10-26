<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showMainDashBoard()
    {
        $cells = Cell::all();
        // GET ALERTS DATA
        $pending = DB::table('alerts')->where('status', '=', 'Pending')->get();
        $optimizations = DB::table('alerts')->where('status', '=', 'Optimization')->get();
        $closed = DB::select("SELECT *
                                FROM PUBLIC.alerts
                                WHERE PUBLIC.alerts.status = 'Closed'
                                AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1");

        $new_install = DB::table('installation_reports')->where('status', '=', 'new')->get();
        $years_install = $this->getThisYearInstallations();

        // PIE CHART DATA
        $pc_data = $this->pieChartData();

        // BAR CHART
        $bc_data = $this->barGraphData();

        // LINE GRAPH - AZIMUTH DATA
        $lc_azim = $this->lineGraphAzimuth();
        $lc_tilt = $this->lineGraphTilt();
        $lc_roll = $this->lineGraphRoll();
        $lc_volt_low = $this->lineGraphLowVolt();
        $lc_volt_drop = $this->lineGraphVoltDrop();
        $lc_comm = $this->lineGraphComm();

        return view('dashboard.dash', compact('cells',
            'pending',
            'optimizations',
            'closed',
            'new_install',
            'years_install',
            'pc_data',
            'bc_data',
            'lc_azim',
            'lc_tilt',
            'lc_roll',
            'lc_volt_low',
            'lc_volt_drop',
            'lc_comm'
        ));
    }

    // DASHBOARD DATA QUERIES
    public function getThisYearInstallations()
    {
        // CARD DATA
        $card_data = DB::select("SELECT COUNT(PUBLIC.installation_reports.id) AS install_count
                                    FROM PUBLIC.installation_reports
                                    WHERE DATE_PART('year', PUBLIC.installation_reports.created_at) > DATE_PART('year', NOW()) - 1");
        return $card_data;
    }

    // DASHBOARD DATA QUERIES
    public function pieChartData()
    {
        // PIE CHART DATA
        $pc_data = DB::select("SELECT PUBLIC.alerts.alert_type, COUNT(PUBLIC.alerts.id) 
                                FROM PUBLIC.alerts 
                                GROUP BY PUBLIC.alerts.alert_type
                                ORDER BY PUBLIC.alerts.alert_type ASC");
        return $pc_data;
    }

    public function barGraphData()
    {
        $bc_data = DB::select("SELECT PUBLIC.alerts.cell_id, COUNT(PUBLIC.alerts.id) as num 
                                FROM PUBLIC.alerts 
                                GROUP BY PUBLIC.alerts.cell_id
                                ORDER BY num DESC
                                LIMIT 5");
        return $bc_data;
    }

    public function lineGraphAzimuth()
    {
        $lc_azim = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'Heading'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS head_count
                                GROUP BY mon"
        );
        return $lc_azim;
    }

    public function lineGraphTilt()
    {
        $lc_tilt = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'Pitch'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS tilt_count
                                GROUP BY mon"
        );
        return $lc_tilt;
    }

    public function lineGraphRoll()
    {
        $lc_roll = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'Roll'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS roll_count
                                GROUP BY mon"
        );
        return $lc_roll;
    }

    public function lineGraphLowVolt()
    {
        $lc_volt_low = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'Low Voltage'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS low_voltage_count
                                GROUP BY mon"
        );
        return $lc_volt_low;
    }

    public function lineGraphVoltDrop()
    {
        $lc_volt_drop = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'Voltage Drop'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS voltage_drop_count
                                GROUP BY mon"
        );
        return $lc_volt_drop;
    }

    public function lineGraphComm()
    {
        $lc_comm = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'No Communication'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS comm_count
                                GROUP BY mon"
        );
        return $lc_comm;
    }
}
