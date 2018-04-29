<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordV2 extends Mailable
{
    use Queueable, SerializesModels;
    protected $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $link)
    {
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password')
                    ->markdown('email.reset_password_v2')
                    ->with(['link' => $this->link]);
    }
}
