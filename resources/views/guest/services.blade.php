<!-- resources/views/welcome.blade.php -->
@extends('layouts.custom-guest') <!-- Utiliser le layout -->

@section('content')
    <!-- Contenu spécifique à la page d'accueil -->
    @include('components.page-title')
    @include('sections.featured-services')
    @include('sections.services')
    @include('sections.faq')
    
@endsection