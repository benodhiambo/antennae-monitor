<?php

namespace App\Jobs;

use App\Mail\ReportEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReportEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $uri;
    public $subject;

    public function __construct($uri,$subject)
    {
        $this->uri =$uri;
        $this->subject =$subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('gnjokikiarie@gmail.com')->send(new ReportEmail($this->uri, $this->subject ));
    }
}
