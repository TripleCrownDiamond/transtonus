<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Quote;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Mail\QuoteRequested;

class ContactController extends Controller
{
    /**
     * Affiche la page de contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function showContactForm()
    {
        $pageTitle = 'messages.nav.contact'; // Titre de la page
        $pageDescription = 'messages.hero.subtitle'; // Description de la page

        return view('guest.contact', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Affiche la page de demande de devis.
     *
     * @return \Illuminate\Http\Response
     */

    public function showQuoteForm()
    {
        $pageTitle = 'messages.nav.quote'; // Titre de la page
        $pageDescription = 'messages.cta.description'; // Description de la page

        return view('guest.quote', compact('pageTitle', 'pageDescription'));
    }
}
