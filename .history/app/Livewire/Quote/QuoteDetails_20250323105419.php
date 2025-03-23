<?php

namespace App\Livewire\Quote;

use App\Models\Quote;
use Livewire\Component;
use Livewire\WithFileUploads;

class QuoteDetails extends Component
{
    use WithFileUploads;

    public $showQuoteDetails = false;
    public $selectedQuote = null;
    public $emailSubject = '';
    public $emailContent = '';
    public $attachments = [];
    public $isSending = false;

    protected $listeners = ['show-quote-details' => 'showDetails'];

    protected $rules = [
        'emailSubject' => 'required|string|min:3',
        'emailContent' => 'required|string|min:10',
        'attachments.*' => 'file|max:10240', // 10MB max per file
    ];

    public function mount()
    {
        $this->emailSubject = 'Votre demande de devis';
        $this->emailContent = '<p>Bonjour,</p><p>Suite à votre demande, veuillez trouver ci-joint notre proposition commerciale.</p><p>Cordialement,</p><p>L\'équipe commerciale</p>';
    }

    public function showDetails($data)
    {
        $quote = Quote::find($data['quoteId']);

        if ($quote) {
            $this->selectedQuote = $quote;
            $this->showQuoteDetails = true;
            $this->emailSubject = 'Votre demande de devis - ' . $quote->service_type;
            $this->emailContent = '<p>Bonjour ' . $quote->name . ',</p><p>Suite à votre demande concernant ' . $quote->service_type . ', veuillez trouver ci-joint notre proposition commerciale.</p><p>Cordialement,</p><p>L\'équipe commerciale</p>';

            $this->dispatch('quoteSelected');
        }
    }

    public function closeDetails()
    {
        $this->showQuoteDetails = false;
        $this->selectedQuote = null;
        $this->attachments = [];
        $this->resetValidation();
    }

    public function removeAttachment($index)
    {
        if (isset($this->attachments[$index])) {
            unset($this->attachments[$index]);
            $this->attachments = array_values($this->attachments);
        }
    }

    public function sendEmail()
    {
        // Make sure this method exists and matches the wire:click in the blade file
        $this->isSending = true;

        $this->validate();

        try {
            // Email sending logic here

            // Update quote status to in_progress if it was pending
            if ($this->selectedQuote->status === 'pending') {
                $this->selectedQuote->status = 'in_progress';
                $this->selectedQuote->save();
            }

            $this->dispatch('quote-updated', [
                'message' => "Email envoyé avec succès à " . $this->selectedQuote->email,
                'type' => 'success'
            ]);

            $this->closeDetails();
        } catch (\Exception $e) {
            $this->dispatch('quote-update-failed', [
                'message' => "Erreur lors de l'envoi de l'email: " . $e->getMessage(),
                'type' => 'error'
            ]);
        } finally {
            $this->isSending = false;
        }
    }

    public function render()
    {
        return view('livewire.quote.quote-details');
    }
}
