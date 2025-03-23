<?php

namespace App\Livewire;

use App\Models\Quote;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;

class ManageQuotes extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Properties for listing and filtering
    public $search = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Properties for quote details and email
    public $selectedQuote = null;
    public $showQuoteDetails = false;
    public $emailContent = '';
    public $emailSubject = '';
    public $attachments = [];
    public $isSending = false;

    // Properties for status update
    public $isUpdatingStatus = false;

    // Listeners for events
    protected $listeners = ['quoteUpdated' => '$refresh'];

    public function mount()
    {
        $this->emailSubject = 'Votre demande de devis';
        $this->emailContent = '<p>Bonjour,</p><p>Suite à votre demande, veuillez trouver ci-joint notre proposition commerciale.</p><p>Cordialement,</p><p>L\'équipe commerciale</p>';
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function showDetails(Quote $quote)
    {
        $this->selectedQuote = $quote;
        $this->showQuoteDetails = true;
        $this->emailSubject = 'Votre demande de devis - ' . $quote->service_type;
        $this->emailContent = '<p>Bonjour ' . $quote->name . ',</p><p>Suite à votre demande concernant ' . $quote->service_type . ', veuillez trouver ci-joint notre proposition commerciale.</p><p>Cordialement,</p><p>L\'équipe commerciale</p>';
    }

    public function closeDetails()
    {
        $this->showQuoteDetails = false;
        $this->selectedQuote = null;
        $this->attachments = [];
        $this->resetValidation();
    }

    public function updateStatus(Quote $quote, $status)
    {
        $this->isUpdatingStatus = true;

        try {
            $quote->status = $status;
            $quote->save();

            $this->dispatch('quote-updated', [
                'message' => "Statut mis à jour avec succès.",
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('quote-update-failed', [
                'message' => "Erreur lors de la mise à jour du statut: " . $e->getMessage(),
                'type' => 'error'
            ]);
        } finally {
            $this->isUpdatingStatus = false;
        }
    }

    public function sendQuoteEmail()
    {
        $this->isSending = true;

        $this->validate([
            'emailSubject' => 'required|string|min:3',
            'emailContent' => 'required|string|min:10',
            'attachments.*' => 'file|max:10240', // 10MB max per file
        ]);

        try {
            // Here you would implement the actual email sending logic
            // For example using Laravel's Mail facade

            /*
            Mail::to($this->selectedQuote->email)
                ->send(new QuoteEmail(
                    $this->selectedQuote,
                    $this->emailSubject,
                    $this->emailContent,
                    $this->attachments
                ));
            */

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
        $quotes = Quote::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('company', 'like', '%' . $this->search . '%')
                        ->orWhere('service_type', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                return $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.manage-quotes', [
            'quotes' => $quotes
        ]);
    }
}
