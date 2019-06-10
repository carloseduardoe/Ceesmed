<?php

namespace CEM\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Message extends Mailable
{
  use Queueable, SerializesModels;

  public function __construct($data, $subject = "Notification") {
    $this->data    = $data;
    $this->subject = $subject;
  }

  public function build() {
    return $this->subject($this->subject)->markdown('mail::message')->with($this->data);
  }
}
