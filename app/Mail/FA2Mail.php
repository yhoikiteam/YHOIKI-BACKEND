<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FA2Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $fa2_code;
    /**
     * Create a new message instance.
     */
    public function __construct($fa2_code)
    {
        $this->fa2_code = $fa2_code;
    }

    public function build()
    {
        return $this->view('emails.FA2Mail')
        ->subject('Code FA2')
        ->with(['token' => $this->fa2_code]);
        // return $this->Inertia::render('Components/Email/VerifyRegister')->subject('Verify Your Email')->with(['token' => $this->token]);
    }
}
