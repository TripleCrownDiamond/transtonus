@extends('layouts.email')

@section('content')
    <div style="text-align: center;">
        <h1>{{ __('messages.email.contact.admin.title') }}</h1>
        <p>{{ __('messages.email.contact.admin.message') }}</p>
    </div>

    <table>
        <tr>
            <th>{{ __('messages.email.contact.form.name_placeholder') }}</th>
            <td>{{ $contact->name }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.contact.form.email_placeholder') }}</th>
            <td>{{ $contact->email }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.contact.form.subject_placeholder') }}</th>
            <td>{{ $contact->subject }}</td>
        </tr>
        <tr>
            <th>{{ __('messages.email.contact.form.message_placeholder') }}</th>
            <td>{{ $contact->message }}</td>
        </tr>
    </table>
@endsection
