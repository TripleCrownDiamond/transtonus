<?php

namespace App\Livewire\Quote;

use Livewire\Component;
use App\Models\Quote;

class QuoteDetails extends Component
{
    public $showQuoteDetails = false;
    public $selectedQuote = null;
    public $emailSubject = '';
    public $emailContent = '';
    public $attachments = [];
    
    protected $listeners = ['showQuoteDetails' => 'loadQuote'];
    
    public function loadQuote($quoteId)
    {
        $this->selectedQuote = Quote::find($quoteId);
        $this->showQuoteDetails = true;
        
        // Préremplir le sujet et le contenu de l'email
        $this->emailSubject = 'Votre devis #' . $this->selectedQuote->id . ' - ' . config('app.name');
        $this->emailContent = $this->getDefaultEmailContent();
    }
    
    public function closeDetails()
    {
        $this->showQuoteDetails = false;
        $this->reset(['selectedQuote', 'emailSubject', 'emailContent', 'attachments']);
    }
    
    private function getDefaultEmailContent()
    {
        // Contenu par défaut de l'email
        return "Bonjour " . $this->selectedQuote->name . ",\n\n"
            . "Nous vous remercions pour votre demande de devis concernant nos services de " 
            . strtolower($this->selectedQuote->service_type) . ".\n\n"
            . "Nous avons bien reçu votre demande et nous sommes en train de l'examiner. "
            . "Un membre de notre équipe vous contactera prochainement pour discuter des détails.\n\n"
            . "Cordialement,\n"
            . "L'équipe " . config('app.name');
    }
    
    public function render()
    {
        return view('livewire.quote.quote-details');
    }
}
