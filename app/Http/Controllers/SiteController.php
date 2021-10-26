<?php

namespace App\Http\Controllers;

use App\AcceptanceReport;
use App\Alert;
use App\Site;
use App\Cell;
use App\InstallationReport;
use App\Monitor;
use App\MonitorData;
use App\TestReport;
use DateInterval;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function uploadCsvFile()
    {
        $path = request()->file('sitelist')->getRealPath(); //find the files location
        return $path;
    }

    public function saveSites()
    {
        $path = $this->uploadCsvFile();
        $file = fopen($path, "r"); //open file in read mode
        $count = 0;
        $failed = 0;

        while (!feof($file))//while its not end of the file opened do the following
        {
            $row_data = fgetcsv($file);


            if (!empty($row_data) && !Site::where(['site_id' => $row_data[2]])->exists()) {

                // save sites
                $data = [
                    'node_id' => $row_data[1],
                    'site_id' => $row_data[2],
                    'site_name' => $row_data[3],
                    'lac' => $row_data[7],
                    'mcc' => $row_data[8],
                    'vendor' => $row_data[11],
                    'lat' => $row_data[13],
                    'long' => $row_data[14]
                ];
                Site::create($data);
                $count++;

            } else {
                $failed++;
            }
        }
        fclose($file);
        Log::info('New sitelist uploaded :' . $count . '  Sites Added' ,['type' =>'create','result' => 'success']);
        return $count . $failed;
    }

    public function saveCells()
    {
        $path = $this->uploadCsvFile();
        $file = fopen($path, "r"); //open file in read mode
        $count = 0;
        $failed = 0;
        $updated = 0;

        while (!feof($file))//while its not end of the file opened do the following
        {
            $row_data = fgetcsv($file);

            if ($row_data) {

                if(Cell::where(['cell_id' => $row_data[6]])->exists())
                {
                    $cell = Cell::where('cell_id',$row_data[6])->first();
                    $cell->heading =$row_data[17];
                    $cell->pitch =$row_data[18];
                    $cell->roll =$row_data[19];
                    $cell->save();
                    $updated++;




                }else{
                    // save cells
                    $data = [
                        'site_id' =>$row_data[2],
                        'cell_name' => $row_data[4],
                        'sector_id' => $row_data[5],
                        'cell_id' => $row_data[6],
                        'mnc' => $row_data[9],
                        'status' => $row_data[10],
                        'technology' => $row_data[12],
                        'bcch_uarfcn_earfcn' => $row_data[15],
                        'bsci_psc_pci' => $row_data[16],
                        'heading' => $row_data[17],
                        'pitch' => $row_data[18],
                        'roll' => $row_data[19],
                    ];
                    Cell::create($data);

                    $count++;

                }

            } else {
                $failed++;
            }
        }
        Log::info('New sitelist uploaded :'.$count . '  Cells Added',['type' =>'create','result' => 'success']);
        Log::info('New sitelist uploaded :' .$updated . '  Cells Updated',['type' =>'update','result' => 'success']);
        fclose($file);
        return $count . $failed;
    }

    public function uploadSitelist()
    {
        $this->saveSites();
        $this->saveCells();
        $sites = Site::all();
        return redirect('/sites');
    }

    //display sitelist
    public function showSitelist()
    {
        $sites = Site::all();
        $alerts = Alert::all();
        return view('sites.sitelist', compact('sites', 'alerts'));
    }

    //SHOW SITE DATA
    public function showSite($site_id)
    {
        $siteData = DB::table('sites')->where('site_id', '=', $site_id)->get();
        $cellData = DB::table('cells')->where('site_id', '=', $site_id)->get();

        $cell_ids = DB::table('cells')->distinct()->where('site_id', '=', $site_id)->get(['cell_id']);
        $id_array = json_decode( json_encode($cell_ids), true);

        $alertData = DB::table('alerts')->whereIn('cell_id', $id_array)->get();

        return view('sites.site_details', compact('siteData', 'cellData', 'alertData'));
    }

    //DISPLAY SITE REPORTS PAGE
    public function showSiteReports()
    {
        $installData = $this->getDataForSiteReports('installation_reports', 'user_id');
        $testData = $this->getDataForSiteReports('test_reports', 'user_id');
        $acceptanceData = $this->getDataForSiteReports('acceptance_reports', 'installation_report_id');
        // $acceptanceData = AcceptanceReport::all();
        return view('sites.site_reports', compact('installData', 'testData', 'acceptanceData'));
    }

    private function getDataForSiteReports($table, $column)
    {
        $id = DB::table($table)->distinct()->get([$column]);
        $id_array = json_decode( json_encode($id), true);

        if ($table == 'installation_reports') {
            $reportUsers = DB::table('users')->whereIn('id', $id_array)->get();
            // $reportData = InstallationReport::all();
            $reportData = $this->getInstallationReportTableDetails();

            foreach ($reportUsers as $user) {
                foreach ($reportData as $data) {
                    if($data->user_id == $user->id){
    
                        // add  user name to test report collection
                        $data->user_name = $user->name;
                    }
                }
            }
        } elseif ($table == 'test_reports') {
            $reportUsers = DB::table('users')->whereIn('id', $id_array)->get();
            $reportData = TestReport::all();

            foreach ($reportUsers as $user) {
                foreach ($reportData as $data) {
                    if($data->user_id == $user->id){
    
                        // add  user name to test report collection
                        $data->user_name = $user->name;
                    }
                }
            }

        } else {
            $reportData = $this->getAcceptanceReportData();
        }
        return $reportData;
    }

    public function editReportStatus($report_id)
    {
        $reportData = DB::table('installation_reports')->where('id', '=', $report_id)->get();
        $reportData = $this->addSiteDetailsToReport($reportData);
        return view('sites.edit_report_status', compact('reportData'));
    }

    public function updateInstallationReportStatus($report_id, Request $request)
    {
        $report = InstallationReport::find($report_id);
        $report->status = $request->status;
        $updateReport = $report->save();

        if ($updateReport)
        {
            Log::info(' Installation Report Status updated', ['type' => 'update', 'result' => 'success']);
        }
        $reportData = DB::table('installation_reports')->where('id', '=', $report_id)->get();
        $reportData = $this->addSiteDetailsToReport($reportData);
        return view('sites.edit_report_status', compact('reportData'));
    }

    public function getInstallationReportTableDetails()
    {
        $reportData = InstallationReport::all();
        $reportData = $this->addSiteDetailsToReport($reportData);

        foreach ($reportData as $data) {
            $acceptanceReportData = AcceptanceReport::where(
                                                        'installation_report_id', 
                                                        '=', 
                                                        $data->id)->get(['id'])->toArray();
            if (array_key_exists(0, $acceptanceReportData)) {
                $data->accept_report_id = $acceptanceReportData[0]['id'];
            }                                           
        }
        return $reportData;
    }

    private function addSiteDetailsToReport($reportData)
    {
        foreach ($reportData as $datum) {
            // Extract Site Id From Report Name
            // Site Id can be used as a search parameter in the table
            $siteId = substr($datum->installation_report, 0, strpos($datum->installation_report, '-'));
            $datum->site_id = $siteId;

            // get user name
            $userName = DB::table('users')->where('id', '=', $datum->user_id)->get('name');
            $datum->user_name = $userName[0]->name;
    
            // Create a formattted Report Name
            $datum->reportName = $this->formatReportName($datum->installation_report);
        }
        return $reportData;
    }

    private function formatReportName($reportName)
    {
        $siteId = substr($reportName, 0, strpos($reportName, '-'));

        $clearName = str_replace($siteId."-","", $reportName);
        $clearName = str_replace(".pdf","", $clearName);
        $clearName = str_replace("InstallationReport","Installation Report", $clearName);
        $clearName = str_replace("AcceptanceReport","Acceptance Form", $clearName);
        $clearName = str_replace("_"," ", $clearName);

        return $clearName;
    }

    private function formatSiteName($siteName)
    {
        $id = explode("-", $siteName);
        $site_id = array_shift($id);

        $name_arr = explode("-", $siteName);
        $remove_id = array_splice($name_arr, 1);
        $raw_name = implode("-", $remove_id);
        $siteName = str_replace('_', ' ', $raw_name);

        return $siteName;
    }

    private function getAcceptanceReportData()
    {
        $acceptanceReportData = AcceptanceReport::all();
        foreach ($acceptanceReportData as $data) {
            $cellData = $this->getCellDataForIR($data->installation_report_id);
            $data->technology = $cellData[0]->technology; 
            
            $data->site_name = $this->getSiteNameForIR($cellData[0]->site_id);

            $data->reportName = $this->getIRNameForAcceptanceReportTable($data->installation_report_id);
        }
        return $acceptanceReportData;
    }

    private function getIRNameForAcceptanceReportTable($install_report_id)
    {
        $reportName = DB::table('installation_reports')
                        ->where('id', '=', $install_report_id)
                        ->get('installation_report')[0]->installation_report;

        $reportName = $this->formatReportName($reportName);
   
        return $reportName;
    }

    private function getCellDataForIR($irID)
    {
        $qrNumber = DB::table('installation_reports')
                        ->where('id', '=', $irID)
                        ->get('qr_number')[0]->qr_number;

        $cellID = DB::table('monitors')
                        ->where('qr_number', '=', $qrNumber)
                        ->get('cell_id')[0]->cell_id;

        $cellData = DB::table('cells')
                        ->where('cell_id', '=', $cellID)
                        ->get(['site_id', 'technology']);

        return $cellData;
    }

    private function getSiteNameForIR($siteID)
    {
        $siteName = DB::table('sites')
                        ->where('site_id', '=', $siteID)
                        ->get(['site_name'])[0]->site_name;

        return $siteName;
    }

    public function showCellDetails($cell_id)
    {
        $cellData = DB::table('cells')->where('cell_id', '=', $cell_id)->get();

        $site_id = DB::table('cells')->where('cell_id', '=', $cell_id)->get(['site_id']);
        $site_id = json_decode( json_encode($site_id), true);

        $siteInfo = DB::table('sites')->where('site_id', '=', $site_id)->get();

        $cellAlerts = DB::table('alerts')->where('cell_id', '=', $cell_id)->get();

        $batteryVoltage = $this->voltageLineGraphData($cell_id);

        return view('sites.cell_details', compact('cellData', 'cellAlerts', 'siteInfo', 'batteryVoltage'));
    }

    public function voltageLineGraphData($cell_id)
    {
        //get current time as a DateTime Object
        $currentTime = \DateTime::createFromFormat('Y-m-d H:i:s', '2020-02-17 06:50:55');
        //$currentTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', time()));
        $lastPeriod = $currentTime->sub(new DateInterval('PT15H'));
        $lastTwelveHours = $lastPeriod->format('Y-m-d H:i:s');

        $cell_id = (string)$cell_id;
        $voltageValues = DB::select("SELECT PUBLIC.monitor_data.voltage, PUBLIC.monitor_data.created_at
                                FROM PUBLIC.monitor_data
                                WHERE PUBLIC.monitor_data.cell_id = '$cell_id' 
                                AND PUBLIC.monitor_data.created_at > '$lastTwelveHours'
                                ORDER BY PUBLIC.monitor_data.created_at ASC"
        );

        // array indices to be selected from the DB result
        $hourlyArrayIndex = array(0,12,24,36,48,60,72,84,96,108,120,144,156,168,180,192,204,216,228,240,252,264,276);

        // array that goes to line chart view with voltage values
        $lc_volt = array();
        foreach ($voltageValues as $key => $value) {
            //select one value per hour and push into array
            if (in_array($key, $hourlyArrayIndex)) {
                array_push($lc_volt, $value);
            }
        }
        return $lc_volt;
    }

    //display sitelist
    public function showCellsList()
    {
        $cells = Cell::all();
        $alerts = Alert::all();
        return view('sites.celllist', compact('cells', 'alerts'));
    }

    //display upload sitelist
    public function showUploadSitelist()
    {
        return view('sites.upload-sites');
    }

    public function showUploadAcceptanceFormPage($installation_report_id)
    {
        $reportData = InstallationReport::where('id', '=', $installation_report_id)->get();
        foreach ($reportData as $report) {
            $report->installation_report_id = $installation_report_id;

            $acceptance = AcceptanceReport::where('installation_report_id', '=', $report->installation_report_id)->get()->toArray();
            if (array_key_exists(0, $acceptance)) {
                $report->acceptance_form_id = $acceptance[0]['id'];
                $report->acceptance_status = $acceptance[0]['status'];
                $report->acceptance_comment = $acceptance[0]['comment'];
                $report->acceptance_form = $acceptance[0]['acceptance_form'];

                // Remove site id and format report Name
                $siteId = substr($report->acceptance_form, 0, strpos($report->acceptance_form, '-'));
                $acceptanceReportName = str_replace($siteId."-","", $report->acceptance_form);
                $report->acceptance_form_name = str_replace("_"," ", str_replace(".pdf","", $acceptanceReportName));
            }
            
            $report->report_name = $this->formatReportName($report->installation_report);

            $technician = User::where('id', '=', $report->user_id)->get(['name']);
            $report->technician = $technician[0]->name;

            $cellID = Monitor::where('qr_number', '=', $report->qr_number)->get(['cell_id','created_at']);
            $report->cell_id = $cellID[0]->cell_id;
            $installed = new DateTime($cellID[0]->created_at);
            $report->date_installed = $installed->format('Y-m-d');

            // $report->site_id2 = Cell::where('cell_id', '=', $cellID[0]->cell_id)->get(['site_id']);
            // $report->site_id2 = $report->site_id2[0]->site_id;
            $report->site_id = substr($report->installation_report, 0, strpos($report->installation_report, '-'));
            $sitename = Site::where('site_id', '=', $report->site_id)->get(['site_name']);
            $report->site_name = $this->formatSiteName($sitename[0]->site_name);
        }
        return view('sites.add_accept_reports', compact('reportData'));
    }

    public function showSummaryPage()
    {
        return view('sites.summary');
    }
    /*
    |--------------------------------------------------------------------------
    | Detailed Page Data Compilation
    |--------------------------------------------------------------------------
    |
    */
    public function showDetailedPage()
    {
        $summaryData = $this->getSummaryData();
        return view('sites.detailed', compact('summaryData'));
    }

    private function getSummaryData()
    {
        // get unique qr numbers
        $unique_qrs = array_unique(
            DB::table('installation_reports')->pluck('qr_number')->toArray()
        );

        sort($unique_qrs);

        /* 
         * Tets area
         * 
         **/
        $unique_qr = array();
        foreach ($unique_qrs as $value) {
            if ($value < 122) {
                array_push($unique_qr, $value);
            }
        }
        /* 
         * Tets area
         * 
         **/
        $cellIDs = DB::table('monitors')->whereIn('qr_number', $unique_qr)->pluck('cell_id')->toArray();

        $cellData = DB::table('cells')->whereIn('cell_id', $cellIDs)->get();

        foreach ($cellData as $data) {
            $name_arr = explode("-", $data->cell_name);
            $remove_id = array_splice($name_arr, 1);
            $raw_name = implode("-", $remove_id);
            $data->cell_name = str_replace('_', ' ', $raw_name);
        }

        $summaryData = $this->addSiteDataToSummary($cellData);
        $summaryData = $this->addAntennaDataToSummary($summaryData);
        $summaryData = $this->addMonitorAssignmentsDataToSummary($summaryData);
        $summaryData = $this->addTestDataToSummary($summaryData);
        $summaryData = $this->addUserDataToSummary($summaryData);
        $summaryData = $this->addTeamDataToSummary($summaryData);
        $summaryData = $this->addContractorDataToSummary($summaryData);
        $summaryData = $this->addInstallDataToSummary($summaryData);
        $summaryData = $this->addImageDataToSummary($summaryData);
        $summaryData = $this->addAcceptDataToSummary($summaryData);

        return $summaryData;
    }

    private function addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol)
    {
        foreach ($cellData as $data) {
            if (!is_null($data->$searchVal)) {
                $getCol = [];
                foreach ($returnCol as $key => $value) {
                    array_push($getCol,$key);
                }

                $getData = DB::table($table)
                            ->where($searchCol, '=', $data->$searchVal)
                            ->get($getCol)
                            ->toArray();

                if (array_key_exists(0, $getData)) {
                    foreach ($returnCol as $key => $value) {
                        $data->$value = $getData[0]->$key;
                    }
                } else {
                    foreach ($returnCol as $key => $value) {
                        $data->$value = '';
                    }
                }
            } else {
                foreach ($returnCol as $key => $value) {
                    $data->$value = '';
                }
            }
        }
        return $cellData;
    }

    private function addSiteDataToSummary($cellData)
    {
        $table = 'sites';
        $searchCol = 'site_id';
        $searchVal = 'site_id';
        $returnCol = array('site_name' => 'site_name');

        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);
        foreach ($cellData as $data) {
            $data->site_name = $this->formatSiteName($data->site_name);
        }
        return $cellData;
    }

    private function addAntennaDataToSummary($cellData)
    {
        $table = 'monitors';
        $searchCol = 'cell_id';
        $searchVal = 'cell_id';
        $returnCol = array(
                            'imsi' => 'imsi', 
                            'qr_number' => 'qr_number', 
                            'installation_time' => 'installation_time',
                            'created_at' => 'date_installed'
                        );
        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);

        return $cellData;
    }

    private function addMonitorAssignmentsDataToSummary($cellData)
    {
        $table = 'monitor_assignments';
        $searchCol = 'qr_number';
        $searchVal = 'qr_number';
        $returnCol = array(
                            'id' => 'assignment_id', 
                            'created_at' => 'date_collected', 
                            'user_id' => 'user_assigned'
                        );
        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);

        foreach ($cellData as $data) {
            $collected = new DateTime($data->date_collected);
            $installed = new DateTime($data->date_installed);

            $data->date_collected = $collected->format('Y-m-d');
            $data->date_installed = $installed->format('Y-m-d');
        }
        return $cellData;
    }

    private function addTestDataToSummary($cellData)
    {
        $table = 'test_reports';
        $searchCol = 'qr_number';
        $searchVal = 'qr_number';
        $returnCol = array('test_report' => 'test_report', 'user_id' => 'test_user_id');

        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);

        foreach ($cellData as $data) {
            $data->test_report_username = substr($data->test_report, 0, strpos($data->test_report, '_'));
            $clearName = str_replace($data->test_report_username."_","", $data->test_report);
            $clearName = str_replace(".pdf","", $clearName);
            $clearName = str_replace("testReport","Test Cert", $clearName);
            $clearName = str_replace("_"," ", $clearName);
            $data->test_report_name = $clearName;
        }
        return $cellData;
    }

    private function addUserDataToSummary($cellData)
    {
        $table = 'users';
        $searchCol = 'id';
        $searchVal = 'test_user_id';
        $returnCol = array('name' => 'user_name', 'team_id' => 'team_id');

        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);
        return $cellData;
    }

    private function addTeamDataToSummary($cellData)
    {
        $table = 'teams';
        $searchCol = 'id';
        $searchVal = 'team_id';
        $returnCol = array('team_name' => 'team_name', 'contractor_id' => 'contractor_id');

        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);
        return $cellData;
    }

    private function addContractorDataToSummary($cellData)
    {
        foreach ($cellData as $data) {
            if (!is_null($data->team_id)) {
                //get teams data for monitor installed in cell
                $getData = $getData = DB::table('contractors')
                            ->where('id', '=', $data->contractor_id)
                            ->get(['contractor_name']);

                $data->contractor_name = $getData[0]->contractor_name;
            } else {
                $data->contractor_name = '';
            }
        }
        return $cellData;
    }

    private function addInstallDataToSummary($cellData)
    {
        $table = 'installation_reports';
        $searchCol = 'qr_number';
        $searchVal = 'qr_number';
        $returnCol = array(
                            'id' => 'installation_report_id', 
                            'installation_report' => 'installation_report', 
                            'status' => 'installation_status'
                        );
        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);

        foreach ($cellData as $data) {
            $data->installation_report_name = $this->formatReportName($data->installation_report);
        }
        return $cellData;
    }
    
    private function addImageDataToSummary($cellData)
    {
        $table = 'installation_images';
        $searchCol = 'cell_id';
        $searchVal = 'cell_id';
        $returnCol = array('id' => 'image_id', 'image' => 'image');
        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);

        foreach ($cellData as $data) {
            $data->image_name = str_replace("installation-image-","", $data->image);
        }
        
        return $cellData;
    }

    private function addAcceptDataToSummary($cellData)
    {
        $table = 'acceptance_reports';
        $searchCol = 'installation_report_id';
        $searchVal = 'installation_report_id';
        $returnCol = array(
                            'comment' => 'acceptance_comment', 
                            'status' => 'acceptance_status', 
                            'acceptance_form' => 'acceptance_form'
                        );
        $cellData = $this->addDataToSummary($cellData, $table, $searchCol, $searchVal, $returnCol);

        foreach ($cellData as $data) {
            $data->acceptance_form_name = $this->formatReportName($data->acceptance_form);
        }
        return $cellData;
    }
}
