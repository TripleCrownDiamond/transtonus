@extends('layouts.custom-guest')

@section('content')
    @include('components.page-title', [
        'pageTitle' => __('messages.nav.privacy-policy'),
        'pageDescription' => __('messages.privacy_content.description'),
    ])

    <section class="policy-section section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="policy-card">
                        <div class="policy-header">
                            <h3>{{ __('messages.nav.privacy-policy') }}</h3>
                            <span class="last-updated">{{ __('messages.privacy_content.last_updated') }}:
                                {{ date('d/m/Y', strtotime($lastUpdated)) }}</span>
                        </div>

                        <div class="policy-body">
                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.introduction.title') }}</h4>
                                <p>{!! __('messages.privacy_content.introduction.content', ['company' => env('APP_COMPANY_LEGAL_NAME')]) !!}</p>
                            </div>

                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.data_collection.title') }}</h4>
                                <p>{!! __('messages.privacy_content.data_collection.content') !!}</p>
                            </div>

                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.data_usage.title') }}</h4>
                                <p>{!! __('messages.privacy_content.data_usage.content') !!}</p>
                            </div>

                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.data_sharing.title') }}</h4>
                                <p>{!! __('messages.privacy_content.data_sharing.content') !!}</p>
                            </div>

                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.cookies.title') }}</h4>
                                <p>{!! __('messages.privacy_content.cookies.content') !!}</p>
                            </div>

                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.data_security.title') }}</h4>
                                <p>{!! __('messages.privacy_content.data_security.content') !!}</p>
                            </div>

                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.user_rights.title') }}</h4>
                                <p>{!! __('messages.privacy_content.user_rights.content') !!}</p>
                            </div>

                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.changes.title') }}</h4>
                                <p>{!! __('messages.privacy_content.changes.content') !!}</p>
                            </div>

                            <div class="policy-section">
                                <h4>{{ __('messages.privacy_content.contact.title') }}</h4>
                                <p>{!! __('messages.privacy_content.contact.content', [
                                    'company' => env('APP_COMPANY_LEGAL_NAME'),
                                    'address' => env('APP_ADDRESS'),
                                    'city' => env('APP_CITY'),
                                    'country' => env('APP_COUNTRY'),
                                    'email' => env('APP_LEGAL_CONTACT_EMAIL'),
                                ]) !!}</p>
                            </div>
                        </div>

                        <div class="policy-footer">
                            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-accent">
                                <i class="bi bi-arrow-left"></i> {{ __('messages.tracking.back_home') }}
                            </a>
                            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="btn btn-accent">
                                {{ __('messages.tracking.contact_us') }} <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Styles for privacy policy page */
        .policy-section.section {
            margin: 60px 0;
            padding: 30px 0;
        }

        .policy-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            width: 100%;
        }

        .policy-header {
            background-color: var(--accent-color);
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .policy-header h3 {
            margin: 0;
            font-weight: 600;
        }

        .last-updated {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .policy-body {
            padding: 30px;
        }

        .policy-section {
            margin-bottom: 30px;
        }

        .policy-section h4 {
            color: var(--accent-color);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .policy-section p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .policy-section ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }

        .policy-section li {
            margin-bottom: 8px;
        }

        .policy-footer {
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #eee;
        }

        .btn-accent {
            background-color: var(--accent-color);
            color: white;
            border: 2px solid var(--accent-color);
            transition: all 0.3s ease;
        }

        .btn-accent:hover {
            background-color: white;
            color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-outline-accent {
            background-color: transparent;
            color: var(--accent-color);
            border: 2px solid var(--accent-color);
            transition: all 0.3s ease;
        }

        .btn-outline-accent:hover {
            background-color: var(--accent-color);
            color: white;
        }
    </style>
@endsection
