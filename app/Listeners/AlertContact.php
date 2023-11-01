<?php

namespace App\Listeners;

use App\Events\Contact;
use App\Models\User;
use App\Notifications\SendQuestionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AlertContact
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
    public function handle(Contact $event): void
    {
        $question = $event->question; 
          $user = User::where('role', 'admin')->first();
         if ($user) {
            $user->notify(new SendQuestionNotification($question));
        }
    }
}
