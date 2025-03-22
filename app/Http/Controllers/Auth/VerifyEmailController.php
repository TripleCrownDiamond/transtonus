<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        // Logique de vérification d'e-mail
        $request->user()->markEmailAsVerified();
        return redirect()->route('dashboard');
    }
}