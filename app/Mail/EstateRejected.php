<?php

namespace App\Mail;

use App\RealEstate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EstateRejected extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var RealEstate
     */
    private $realestate;

    /**
     * Create a new message instance.
     *
     * @param RealEstate $realestate
     */
    public function __construct(RealEstate $realestate)
    {
        $this->realestate = $realestate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('Publicación rechazada'))
            ->markdown('emails.estate_rejected')
            ->with('realestate', $this->realestate);
    }
}
