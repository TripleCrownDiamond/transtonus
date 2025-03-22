@extends('layouts.email')

@section('content')
    <div style="text-align: center;">
        <h1 style="color: #001973; font-family: 'Poppins', sans-serif;">
            {{ __('messages.email.quote.admin.title') }}
        </h1>
        <p>{{ __('messages.email.quote.admin.message') }}</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 1.5rem;">
            <tr>
                <th style="background-color: #001973; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.quote.form.name_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $quote->name }}</td>
            </tr>
            <tr>
                <th style="background-color: #001973; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.quote.form.email_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $quote->email }}</td>
            </tr>
            <tr>
                <th style="background-color: #001973; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.quote.form.phone_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $quote->phone }}</td>
            </tr>
            <tr>
                <th style="background-color: #001973; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.quote.form.company_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $quote->company ?? 'Non renseigné' }}</td>
            </tr>
            <tr>
                <th style="background-color: #001973; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.quote.form.service_type') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $quote->service_type }}</td>
            </tr>
            <tr>
                <th style="background-color: #001973; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.quote.form.origin') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $quote->origin }}</td>
            </tr>
            <tr>
                <th style="background-color: #001973; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.quote.form.destination') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $quote->destination }}</td>
            </tr>
            <tr>
                <th style="background-color: #001973; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.quote.form.details_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $quote->details }}</td>
            </tr>
        </table>
    </div>
@endsection