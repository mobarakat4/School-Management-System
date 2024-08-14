<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// use Kreait\Firebase\Messaging\CloudMessage;
// use Kreait\Firebase\Messaging\Notification as FcmNotification;
// use Kreait\Firebase\Messaging\CloudMessage\Notification as FcmNotificationMessage;

use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class ProfileChanged extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['database'];
        return [FcmChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }
    // public function toFcm($notifiable)
    // {
    //     return CloudMessage::withTarget('token',env('MY_TOKEN'))
    //         ->withNotification(FcmNotification::create('Profile Updated', 'Your Profile updated successfuly'));
    // }
    public function toFcm($notifiable): FcmMessage
    {

        return (new FcmMessage(notification: new FcmNotification(
                title: 'profile Updated',
                body: 'Your account updated Successfuly',
                // image: 'http://example.com/url-to-image-here.png'
        )));
            //->data(['data1' => 'value', 'data2' => 'value2'])
            // ->custom([
            //     'android' => [
            //         'notification' => [
            //             'color' => '#0A0A0A',
            //         ],
            //         'fcm_options' => [
            //             'analytics_label' => 'analytics',
            //         ],
            //     ],
            //     'apns' => [
            //         'fcm_options' => [
            //             'analytics_label' => 'analytics',
            //         ],
            //     ],
            // ]);
    }
    public function toDatabase($data)
    {

        return [
            'message' => 'Profile Updated successfully.',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
