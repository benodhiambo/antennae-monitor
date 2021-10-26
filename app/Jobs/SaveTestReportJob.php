<?php

namespace App\Jobs;

use App\TestReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveTestReportJob implements ShouldQueue
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
        $testreport = TestReport::create([
            'qr_number' => $this->data['qr_number'],
            'test_report' => $this->data['name']."_".$this->data['qr_number'] . '_testReport.pdf',
            'status' => $this->data['test'],
            'user_id' => $this->data['user_id'],
        ]);
    }
}
