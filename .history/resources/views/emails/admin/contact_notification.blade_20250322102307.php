@extends('layouts.email')

@section('content')
    <div style="text-align: center;">
        <h1 style="color: #5E0035; font-family: 'Poppins', sans-serif;">
            {{ __('messages.email.contact.admin.title') }}
        </h1>
        <p>{{ __('messages.email.contact.admin.message') }}</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 1.5rem;">
            <tr>
                <th style="background-color: #5E0035; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.contact.form.name_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $contact->name }}</td>
            </tr>
            <tr>
                <th style="background-color: #5E0035; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.contact.form.email_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $contact->email }}</td>
            </tr>
            <tr>
                <th style="background-color: #5E0035; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.contact.form.subject_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $contact->subject }}</td>
            </tr>
            <tr>
                <th style="background-color: #5E0035; color: white; padding: 12px; text-align: left;">
                    {{ __('messages.email.contact.form.message_placeholder') }}
                </th>
                <td style="padding: 12px; text-align: left;">{{ $contact->message }}</td>
            </tr>
        </table>
    </div>
@endsection