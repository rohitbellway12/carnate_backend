<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Your Password Has Been Reset')
            ->view('emails.unified.password-reset-success');
    }
}




