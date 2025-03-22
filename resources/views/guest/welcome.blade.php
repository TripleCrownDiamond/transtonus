<!-- resources/views/welcome.blade.php -->
@extends('layouts.custom-guest') <!-- Utiliser le layout -->

@section('content')
    <!-- Contenu spécifique à la page d'accueil -->
    @include('sections.hero')
    @include('sections.featured-services')
    @include('sections.about')
    @include('sections.services')
    @include('sections.cta')
    @include('sections.faq')
    @include('sections.testimonials')
    <!-- Ajoutez d'autres sections ici -->
@endsection