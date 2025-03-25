<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quote;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminQuoteRequestNotification;
use App\Mail\UserQuoteReceivedConfirmationNotification;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class QuoteForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $company;
    public $service_type;
    public $origin;
    public $destination;
    public $details;
    public $locale;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'company' => 'nullable|string|max:255',
        'service_type' => 'required|string',
        'origin' => 'nullable|string|max:255',
        'destination' => 'nullable|string|max:255',
        'details' => 'nullable|string',
    ];

    public function mount()
    {
        $this->locale = App::getLocale();
    }

    public function quoteSubmit()
    {
        // Vérifier si la validation échoue
        $validatedData = $this->validate();

        Log::info('Début de la création du devis.');

        // Vérifier si la création du devis fonctionne
        $quote = Quote::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'service_type' => $this->service_type,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'details' => $this->details,
            'locale' => $this->locale,
            'status' => 'pending',
        ]);

        Log::info('Devis créé avec succès.', ['quote_id' => $quote->id]);

        // Vérifier l'email admin
        $adminEmail = env('APP_EMAIL');
        // dd('Admin email', $adminEmail);

        if (empty($adminEmail)) {
            Log::error('L\'adresse e-mail de l\'admin n\'est pas configurée dans le fichier .env.');
            LivewireAlert::title(__('messages.swal.error_title'))
                ->text(__('messages.swal.error.admin_email_not_configured'))
                ->error()
                ->show();
            return;
        }

        Log::info('Tentative d\'envoi d\'e-mail à l\'admin.', ['admin_email' => $adminEmail]);

        try {
            // Vérifier avant l'envoi d'email à l'admin
            // dd('Avant envoi email admin');

            Mail::to($adminEmail)->send(new AdminQuoteRequestNotification($quote));

            // Vérifier après l'envoi d'email à l'admin
            // dd('Email admin envoyé');

            Log::info('E-mail à l\'admin envoyé avec succès.');

            // Vérifier avant l'envoi d'email à l'utilisateur
            // dd('Avant envoi email utilisateur', $this->email);

            Mail::to($this->email)->send(new UserQuoteReceivedConfirmationNotification($quote));

            // Vérifier après l'envoi d'email à l'utilisateur
            // dd('Email utilisateur envoyé');

            Log::info('E-mail de confirmation à l\'utilisateur envoyé avec succès.');

            // Vérifier avant le reset
            // dd('Avant reset');

            $this->reset();

            // Vérifier avant l'alerte
            // dd('Avant alerte de succès');

            LivewireAlert::title(__('messages.swal.success_title'))
                ->text(__('messages.quote.success'))
                ->success()
                ->show();

            // dd('Après alerte de succès');
        } catch (\Exception $e) {
            // Vérifier l'exception
            dd('Exception attrapée', $e->getMessage(), $e->getTraceAsString());

            Log::error('Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);

            LivewireAlert::title(__('messages.swal.error_title'))
                ->text(__('messages.swal.error.email_send_failed'))
                ->error()
                ->show();
        }
    }

    public function render()
    {
        return view('livewire.quote-form');
    }
}