<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name= $this->data['name'];
        $email= $this->data['email'];
        $message = $this->data['message'];
        $phone = $this->data['phone'];
        return $this->subject('Subject Email')
            ->view('mail.Test_mail', compact('name','email','phone','message'))
            ->attach($this->data['resume']->getRealPath(),[
                'as' => $this->data['resume']->getClientOriginalName()

            ]);
    }
}