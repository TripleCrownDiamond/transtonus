@extends('layouts.email')

@section('content')
    <div style="text-align: center;">
        <h1 style="color: #001973; font-family: 'Poppins', sans-serif;">
            {{ __('messages.email.contact.confirmation.title') }}
        </h1>
        <p>{{ __('messages.email.contact.confirmation.success') }}</p>
    </div>
@endsection