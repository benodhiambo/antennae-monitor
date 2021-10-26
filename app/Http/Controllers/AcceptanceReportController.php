<?php

namespace App\Http\Controllers;

use App\AcceptanceReport;
use App\Http\Controllers\Controller;
use App\InstallationReport;
use App\Monitor;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AcceptanceReportController extends Controller
{
    public function saveAcceptanceReport(Request $request)
    {
        $fileName = $this->formatDBReportName($request->installation_report_name);
        $request->file('acceptanceForm')->storeAs('public/AcceptanceForms', $fileName);
        
        $report = new AcceptanceReport();
        $report->installation_report_id = $request->installation_report_id;
        $report->comment = $request->acceptanceComment;
        $report->status = $request->acceptanceStatus;
        $report->acceptance_form = $fileName;
        $report->save();
        return back();
    }

    public function formatDBReportName($reportName)
    {
        $reportName = str_replace("InstallationReport","Acceptance_Form", $reportName);
        return $reportName;
    }

    public function formatViewReportName($reportName)
    {
        $siteId = substr($reportName, 0, strpos($reportName, '-'));
        $reportName = str_replace($siteId."-","", $reportName);
        $reportName = str_replace("_"," ", $reportName);
        $reportName = str_replace(".pdf","", $reportName);
        return $reportName;
    }

    public function showUpdateStatusPage($id, Request $request)
    {
        $reportData = AcceptanceReport::where('id', '=', $id)->get();
        $this->addAcceptanceDetailsToReport($reportData);
        return view('sites.edit_acceptance_status', compact('reportData'));
    }

    public function updateAcceptanceDetails($id, Request $request)
    {
        $report = AcceptanceReport::find($id);

        if (isset($request->acceptanceForm)) {
            $fileName = $this->formatDBReportName($request->installation_report_name);
            $request->file('acceptanceForm')->storeAs('public/AcceptanceForms', $fileName);
            $report->acceptance_form = $fileName;
        } 

        $report->comment = $request->acceptanceComment;
        $report->status = $request->acceptanceStatus;

        $updateReport = $report->update();

        if ($updateReport)
        {
            Log::info(' Acceptance Report Status updated', ['type' => 'update', 'result' => 'success']);
        }
        return redirect()->route('show-acceptance-form', ['installation_report_id' => $request->installation_report_id]);
    }

    private function addAcceptanceDetailsToReport($reportData)
    {
        foreach ($reportData as $data) {
            $data->acceptance_report_name = $data->acceptance_form;
            $data->reportName = $this->formatViewReportName($data->acceptance_form);
            $data->installationReport = InstallationReport::where('id', '=', $data->id)->get(['installation_report', 'qr_number', 'user_id']);
            $data->installation_report = $data->installationReport[0]->installation_report;
            $data->report_name = $this->formatReportName($data->installation_report);
            $data->site_id = substr($data->installationReport[0]->installation_report, 0, strpos($data->installationReport[0]->installation_report, '-'));
            $data->site_name = str_replace(" Acceptance Form"," ", $data->reportName);
            
            $cellID = Monitor::where('qr_number', '=', $data->installationReport[0]->qr_number)->get(['cell_id','created_at']);
            $installed = new DateTime($cellID[0]->created_at);
            $data->date_installed = $installed->format('Y-m-d');

            $technician = User::where('id', '=', $data->installationReport[0]->user_id)->get(['name']);
            $data->technician = $technician[0]->name;
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

}
