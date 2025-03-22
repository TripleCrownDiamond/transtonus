<!-- resources/views/welcome.blade.php -->
@extends('layouts.custom-guest') <!-- Utiliser le layout -->

@section('content')
    <!-- Contenu spécifique à la page d'accueil -->
    @include('components.page-title', ['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription])
    @include('components.contact-section')

    
@endsection