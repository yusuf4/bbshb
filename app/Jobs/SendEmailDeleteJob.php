<?php

namespace App\Jobs;

use App\Notifications\ShartnomaExpired;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendEmailDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $dujonibaname;
    protected $username;
    public function __construct($dujonibaname, $username)
    {
        $this->dujonibaname = $dujonibaname;
        $this->username = $username;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $recipients = [
            'ysafarov8@gmail.com' => 'Yusuf Doe',
            'yusuf@mfa.tj'=> 'Some name',
            'legaldepartment@mfa.tj'=> 'Depositary'
        ];
        Notification::route('mail', $recipients)->notify(new ShartnomaExpired($this->dujonibaname, $this->username));
    }
}
