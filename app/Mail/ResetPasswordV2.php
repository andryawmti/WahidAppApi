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
    protected $user;

    /**
     * ResetPasswordV2 constructor.
     * @param string $link
     * @param $user
     */
    public function __construct(string $link, $user)
    {
        $this->link = $link;
        $this->user = $user;
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
                    ->with(['link' => $this->link, 'user' => $this->user]);
    }
}
