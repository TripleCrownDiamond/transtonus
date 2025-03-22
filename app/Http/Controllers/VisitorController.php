<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    // Afficher le nombre total de visiteurs
    public function totalVisitors()
    {
        $totalVisitors = Visitor::count();
        return view('admin.visitors.total', compact('totalVisitors'));
    }

    // Afficher le pays avec le plus de visiteurs
    public function topCountry()
    {
        $topCountry = Visitor::select('country')
            ->groupBy('country')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        return view('admin.visitors.top_country', compact('topCountry'));
    }

    // Afficher toutes les visites
    public function allVisits()
    {
        $visits = Visitor::orderBy('created_at', 'desc')->get();
        return view('admin.visitors.all', compact('visits'));
    }
}
