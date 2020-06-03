<?php

namespace App\Mail;

use App\RealEstate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientSaveEstate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var RealEstate
     */
    private $estate;
    private $client_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RealEstate $estate, $client_name)
    {
        $this->estate = $estate;
        $this->client_name = $client_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__("Nuevo cliente interesado en la propiedad"))
            ->markdown('emails.client_save_estate')
            ->with('estate', $this->estate)
            ->with('client', $this->client_name);
            
    }
}
