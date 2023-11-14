<?php

namespace App\Notifications;

use App\Events\Job;
use App\Models\Job as ModelsJob;
use App\Models\JobUser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;


class JobNotification extends Notification
{
    use Queueable;

    protected $job ;
    protected $user ;

    /**
     * Create a new notification instance.
     */
    public function __construct(ModelsJob $job , User $user)
    {
        $this->job = $job ;
        $this->user = $user ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting("Hello {$this->user->first_name}")
                    ->subject("{$this->user->first_name} applied for a job {$this->job->name}")
                    ->line("{$this->user->first_name} applied for a job {$this->job->name}")
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toDatabase(object $notifiable)
    {
         return  [
            'subject' => ("{$this->user->first_name} applied for a job {$this->job->name}"),
         ];
    }

    // public function toVonage(object $notifiable): VonageMessage
    // {

    //     $body= sprintf("{$this->user->first_name} applied for a job {$this->job->name}") ;
    //     return (new VonageMessage)
    //                 ->content( $body);
    // }




    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
