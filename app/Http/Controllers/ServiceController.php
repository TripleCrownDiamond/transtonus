<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Affiche tous les services disponibles.
     *
     * @return \Illuminate\Http\Response
     */
    public function allServices()
    {
        $services = [
            'storage' => 'services.storage_title',
            'logistics' => 'services.logistics_title',
            'cargo' => 'services.cargo_title',
            'trucking' => 'services.trucking_title',
            'packaging' => 'services.packaging_title',
            'warehousing' => 'services.warehousing_title',
        ];

        $pageTitle = 'messages.services.section_title'; // Titre de la page
        $pageDescription = 'messages.services.section_description'; // Description de la page

        return view('guest.services', compact('services', 'pageTitle', 'pageDescription'));
    }
}