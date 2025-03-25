@extends('layouts.email')

@section('content')
    <div style="text-align: center;">
        <h1>{{ __('messages.email.quote.confirmation.title') }}</h1>
        <p>{{ __('messages.email.quote.confirmation.success') }}</p>

        <p style="margin-top: 30px;">
            <a href="{{ config('app.url') }}" class="btn">{{ __('messages.nav.home') }}</a>
        </p>
    </div>
@endsection
