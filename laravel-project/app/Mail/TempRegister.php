<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TempRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct($url)
    {
      $this->url=$url;
        //
    }

    public function build()
    {
      return $this->subject('本登録認証メール')->view('emails.temp_register')->with(['url',$this->url,]);
    }
  }