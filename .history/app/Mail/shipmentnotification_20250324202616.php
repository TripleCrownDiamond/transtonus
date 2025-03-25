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
    public $isUpdate;
    public $changedFields;

    /**
     * Create a new message instance.
     */
    public function __construct(Shipment $shipment, $isUpdate = false, $changedFields = [])
    {
        $this->shipment = $shipment;
        $this->isUpdate = $isUpdate;
        $this->changedFields = $changedFields;

        // Récupérer le paiement associé si nécessaire
        $this->shipment->load('payments.currency');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->isUpdate
            ? __('messages.shipment_emailsshipment_update_subject', ['tracking' => $this->shipment->tracking_number])
            : __('messages.shipment_emailsshipment_notification_subject', ['tracking' => $this->shipment->tracking_number]);

        return $this->subject($subject)
            ->view('emails.shipment.notification');
    }
}