<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TermsController extends Controller
{
    public function show()
    {
        $locale = App::getLocale();
        $terms = __('messages.terms_content');
        $lastUpdated = env('APP_TERMS_LAST_UPDATED');

        return view('guest.terms', compact('terms', 'lastUpdated'));
    }
}