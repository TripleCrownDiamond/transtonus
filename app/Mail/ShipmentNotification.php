<?php

namespace App\Mail;

use App\Models\Shipment;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShipmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $shipment;
    public $payment;

    /**
     * Create a new message instance.
     */
    public function __construct(Shipment $shipment, Payment $payment = null)
    {
        $this->shipment = $shipment;
        $this->payment = $payment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('messages.shipment_notification_subject', ['tracking' => $this->shipment->tracking_number]),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.shipment.notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}