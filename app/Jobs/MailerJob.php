<?php

namespace App\Jobs;

use App\Interfaces\MailerInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Mailer;

class MailerJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $mailer;
    protected $recipients;
    protected $content;
    public function __construct($recipients, $content)
    {
        $this->mailer=new Mailer();
        $this->recipients=$recipients;
        $this->content=$content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $this->mailer->send_mail($this->recipients, $this->content);
    }
}