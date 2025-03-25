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

    /**
     * Update a shipment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // This method will be implemented later
        // It will handle shipment updates
        
        return back()->with('success', 'Expédition mise à jour avec succès.');
    }
}
