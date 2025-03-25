<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackShipment extends Controller
{
    /**
     * Search for a shipment by tracking number
     */
    public function search(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string'
        ]);

        $shipment = Shipment::where('tracking_number', $request->tracking_number)->first();

        if (!$shipment) {
            return redirect()->back()->with('error', __('messages.tracking.not_found'));
        }

        return redirect()->route('shipment.track', [
            'locale' => app()->getLocale(),
            'shipment' => $shipment->tracking_number
        ]);
    }

    /**
     * Display the tracking information for a shipment
     */
    public function track($locale, $trackingNumber)
    {
        $shipment = Shipmen::where('tracking_number', $trackingNumber)
            ->with('payments.currency')
            ->first();

        if (!$shipment) {
            return redirect()->route('home', ['locale' => $locale])
                ->with('error', __('messages.tracking.not_found'));
        }

        $pageTitle = __('messages.tracking.title');
        $pageDescription = __('messages.tracking.description', ['number' => $trackingNumber]);

        return view('guest.tracking', compact('shipment', 'pageTitle', 'pageDescription'));
    } //
}