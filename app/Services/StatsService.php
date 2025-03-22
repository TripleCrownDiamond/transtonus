<?php

namespace App\Services;

use App\Models\Visitor;
use App\Models\Quote;
use App\Models\Shipment;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class StatsService
{
    public function getVisitorStats()
    {
        return [
            'topCountry' => Visitor::select('country')
                ->where('country', '!=', 'Inconnu')
                ->where('country', '!=', '')
                ->whereNotNull('country')
                ->groupBy('country')
                ->orderByRaw('COUNT(*) DESC')
                ->first(),

            // Compter les IPs uniques pour le total des visiteurs
            'totalVisitors' => Visitor::select('ip_address')
                ->distinct()
                ->count(),

            // Compter les IPs uniques pour aujourd'hui
            'todayVisitors' => Visitor::select('ip_address')
                ->whereDate('created_at', today())
                ->distinct()
                ->count(),
        ];
    }

    public function getQuoteStats()
    {
        return [
            'totalQuotes' => Quote::count(),
            'pendingQuotes' => Quote::where('status', 'pending')->count(),
            'inProgressQuotes' => Quote::where('status', 'in_progress')->count(),
            'completedQuotes' => Quote::where('status', 'completed')->count(),
        ];
    }

    public function getShipmentStats()
    {
        return [
            'totalShipments' => Shipment::count(),
            'processingShipments' => Shipment::where('status', 'processing')->count(),
            'inTransitShipments' => Shipment::where('status', 'in_transit')->count(),
            'deliveredShipments' => Shipment::where('status', 'delivered')->count(),
            'delayedShipments' => Shipment::where('status', 'delayed')->count(),
            'exceptionShipments' => Shipment::where('status', 'exception')->count(),
        ];
    }

    public function getContactStats()
    {
        return [
            'totalContacts' => Contact::count(),
            'unreadContacts' => Contact::where('is_read', false)->count(),
        ];
    }
}
