<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
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
            // Instead of redirecting back, redirect to track view with the not found tracking number
            return redirect()->route('shipment.track', [
                'locale' => app()->getLocale(),
                'shipment' => $request->tracking_number
            ])->with('error', __('messages.tracking.not_found'));
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
        $shipment = Shipment::where('tracking_number', $trackingNumber)
            ->with('payments.currency')
            ->first();

        $pageTitle = __('messages.tracking.title');
        $pageDescription = __('messages.tracking.description', ['number' => $trackingNumber]);

        // If shipment not found, pass null shipment to the view with error message
        if (!$shipment) {
            $notFoundMessage = __('messages.tracking.not_found');
            return view('guest.tracking', compact('trackingNumber', 'pageTitle', 'pageDescription', 'notFoundMessage'));
        }

        return view('guest.tracking', compact('shipment', 'pageTitle', 'pageDescription'));
    }
}
