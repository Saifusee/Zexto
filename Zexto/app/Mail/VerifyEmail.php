<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user_id;
    public $user_username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_recieve, $username_recieve)
    {
       $this->user_id = $id_recieve;
       $this->user_username = $username_recieve;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $string1 = 'this is my site and you would love it';
        $string2 = 'and i m now verifying the email, and its good to check it';
        $id = $this->user_id; //User id we recieve
        $username = $this->user_username; //User id we recieve
        $decode_string = $string1.$id.$string2.$id.$username.$string1.$username.$string2;  //Creating a random string.
        $token = base64_encode($decode_string);  //Generating token with the string we created.
        $link = env('FRONTEND_URL').'verify-email/'.$token.'/verify';

        return $this->from('khaninc.9829@gmail.com', 'Zexto Administration')
                    ->subject('Mailtrap Confirmation')
                    ->markdown('emails.mail')
                    ->with([
                        'name' => 'New Mailtrap USer',
                        'link' => $link,
                        'id' => $id,
                        'username' => $username,
                    ]);
    }
}
