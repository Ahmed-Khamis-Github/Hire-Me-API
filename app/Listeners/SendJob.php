<?php

namespace App\Listeners;

use App\Events\Job;
use App\Models\Company;
use App\Notifications\JobNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendJob
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Job $event): void
    {
        $job = $event->job; 
        $user = $event->user; 
        $company = Company::where('id', $job->company_id)->first();
         if ($company) {
            $company->notify(new JobNotification($job , $user));
        }
    }
}
