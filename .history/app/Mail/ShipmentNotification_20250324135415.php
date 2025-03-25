<?php

namespace App\Mail;

use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShipmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $shipment;

    /**
     * Create a new message instance.
     */
    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
        // Récupérer le paiement associé si nécessaire
        $this->shipment->load('payments.currency');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject(__('messages.shipment_notification_subject', ['tracking' => $this->shipment->tracking_number]))
            ->view('emails.shipment.notification');
    }
}
