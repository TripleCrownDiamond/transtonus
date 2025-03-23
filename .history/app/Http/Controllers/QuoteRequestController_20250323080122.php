<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function index()
    {
        // Passer les données à la vue
        return view('quotes');
    }
}