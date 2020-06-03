<?php

namespace App\Mail;

use App\RealEstate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EstateApproved extends Mailable
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
            ->subject(__('Publicación aceptada'))
            ->markdown('emails.estate_approved')
            ->with('realestate', $this->realestate);
    }
}
