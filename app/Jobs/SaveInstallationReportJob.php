<?php

namespace App\Jobs;

use App\InstallationReport;
use App\TestReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveInstallationReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public  $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $report = InstallationReport::create([
            'site_name' => $this->data['site_name'],
            'technology' => $this->data['technology'],
            'installation_report' => $this->data['site_name']."_".$this->data['technology'] . '_InstallationReport.pdf',
            'status' => $this->data['Pending'],
            'user_id' => $this->data['user_id'],
        ]);
    }
}
