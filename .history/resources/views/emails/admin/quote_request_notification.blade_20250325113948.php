@extends('layouts.email')

@section('content')
    <div style="text-align: center;">
        <h1>{{ __('messages.email.quote.admin.title') }}</h1>
        <p>{{ __('messages.email.quote.admin.message') }}</p>
    </div>

    <table>
        <tr>
            <th>{{ __('messages.email.quote.form.name_placeholder') }}</th>
            <td>{{ $quote->name }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.quote.form.email_placeholder') }}</th>
            <td>{{ $quote->email }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.quote.form.phone_placeholder') }}</th>
            <td>{{ $quote->phone }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.quote.form.company_placeholder') }}</th>
            <td>{{ $quote->company ?? 'Not provided' }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.quote.form.service_type') }}</th>
            <td>{{ $quote->service_type }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.quote.form.origin') }}</th>
            <td>{{ $quote->origin }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.quote.form.destination') }}</th>
            <td>{{ $quote->destination }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.quote.form.details_placeholder') }}</th>
            <td>{{ $quote->details }}</td>
        </tr>
    </table>
@endsection
