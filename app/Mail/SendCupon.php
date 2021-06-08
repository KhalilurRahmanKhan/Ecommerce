<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCupon extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */


    private $cupon_name_to_send="";

    public function __construct($cupun_name)
    {
     
        $this->cupon_name_to_send=$cupun_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.sendcupon',[
            'cupon_name_to_send'=>$this->cupon_name_to_send,
        ]);
    }
}
