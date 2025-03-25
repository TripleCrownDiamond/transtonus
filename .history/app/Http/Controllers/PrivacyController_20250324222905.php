<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PrivacyController extends Controller
{
    public function show()
    {
        $locale = App::getLocale();
        $policy = __('messages.privacy_content');
        $lastUpdated = env('APP_PRIVACY_LAST_UPDATED');

        return view('guest.policy', compact('policy', 'lastUpdated'));
    }
}