@extends('layouts.email')

@section('content')
    <div style="text-align: center;">
        <h1 style="color: #5E0035; font-family: 'Poppins', sans-serif;">
            {{ __('messages.email.quote.confirmation.title') }}
        </h1>
        <p>{{ __('messages.email.quote.confirmation.success') }}</p>
    </div>
@endsection