<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentController extends Controller 
{
    /**
     * Display the shipments management page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('shipments');
    }
}