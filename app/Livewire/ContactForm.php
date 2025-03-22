<?php

namespace App\Livewire;

use App\Mail\AdminContactNotification;
use Livewire\Component;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserContactConfirmation;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Log;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ];

    protected $messages = [
        'name.required' => 'validation.name.required',
        'name.string' => 'validation.name.string',
        'name.max' => 'validation.name.max',
        'email.required' => 'validation.email.required',
        'email.email' => 'validation.email.email',
        'email.max' => 'validation.email.max',
        'subject.required' => 'validation.subject.required',
        'subject.string' => 'validation.subject.string',
        'subject.max' => 'validation.subject.max',
        'message.required' => 'validation.message.required',
        'message.string' => 'validation.message.string',
    ];

    public function submit()
    {
        $this->validate();

        // Créer un nouveau contact
        $contact = Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        // Envoyer un e-mail à l'admin
        $adminEmail = env('APP_EMAIL');
        if (empty($adminEmail)) {
            LivewireAlert::title(__('messages.swal.error_title'))
                ->text(__('messages.swal.error.admin_email_not_configured')) // Mise à jour de la clé
                ->error()
                ->show();
            return;
        }

        try {
            // Envoyer un e-mail à l'admin
            Mail::to($adminEmail)->send(new AdminContactNotification($contact));

            // Envoyer un e-mail de confirmation à l'utilisateur
            Mail::to($this->email)->send(new UserContactConfirmation($contact));

            // Réinitialiser les champs du formulaire
            $this->reset();

            LivewireAlert::title(__('messages.swal.success_title'))
                ->text(__('messages.contact.success'))
                ->success()
                ->show();
        } catch (\Exception $e) {
            // Log de l'erreur
            Log::error('Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage());

            // Afficher un message d'erreur en cas d'échec
            LivewireAlert::title(__('messages.swal.error_title'))
                ->text(__('messages.swal.error.email_send_failed')) // Mise à jour de la clé
                ->error()
                ->show();
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}