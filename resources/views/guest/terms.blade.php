@extends('layouts.custom-guest')

@section('content')
    @include('components.page-title', [
        'pageTitle' => __('messages.footer.terms'),
        'pageDescription' => __('messages.terms_content.description'),
    ])

    <section class="terms-section section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="terms-card">
                        <div class="terms-header">
                            <h3>{{ __('messages.footer.terms') }}</h3>
                            <span class="last-updated">{{ __('messages.terms_content.last_updated') }}:
                                {{ date('d/m/Y', strtotime($lastUpdated)) }}</span>
                        </div>

                        <div class="terms-body">
                            <div class="terms-section">
                                <h4>{{ __('messages.terms_content.introduction.title') }}</h4>
                                <p>{!! __('messages.terms_content.introduction.content', ['company' => env('APP_COMPANY_LEGAL_NAME')]) !!}</p>
                            </div>

                            <div class="terms-section">
                                <h4>{{ __('messages.terms_content.services.title') }}</h4>
                                <p>{!! __('messages.terms_content.services.content') !!}</p>
                            </div>

                            <div class="terms-section">
                                <h4>{{ __('messages.terms_content.responsibilities.title') }}</h4>
                                <p>{!! __('messages.terms_content.responsibilities.content') !!}</p>
                            </div>

                            <div class="terms-section">
                                <h4>{{ __('messages.terms_content.liability.title') }}</h4>
                                <p>{!! __('messages.terms_content.liability.content') !!}</p>
                            </div>

                            <div class="terms-section">
                                <h4>{{ __('messages.terms_content.payment.title') }}</h4>
                                <p>{!! __('messages.terms_content.payment.content') !!}</p>
                            </div>

                            <div class="terms-section">
                                <h4>{{ __('messages.terms_content.termination.title') }}</h4>
                                <p>{!! __('messages.terms_content.termination.content') !!}</p>
                            </div>

                            <div class="terms-section">
                                <h4>{{ __('messages.terms_content.jurisdiction.title') }}</h4>
                                <p>{!! __('messages.terms_content.jurisdiction.content', ['jurisdiction' => env('APP_COMPANY_JURISDICTION')]) !!}</p>
                            </div>

                            <div class="terms-section">
                                <h4>{{ __('messages.terms_content.contact.title') }}</h4>
                                <p>{!! __('messages.terms_content.contact.content', [
                                    'company' => env('APP_COMPANY_LEGAL_NAME'),
                                    'address' => env('APP_ADDRESS'),
                                    'city' => env('APP_CITY'),
                                    'country' => env('APP_COUNTRY'),
                                    'email' => env('APP_LEGAL_CONTACT_EMAIL'),
                                ]) !!}</p>
                            </div>
                        </div>

                        <div class="terms-footer">
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
        /* Styles for terms page */
        .terms-section.section {
            margin: 60px 0;
            padding: 30px 0;
        }

        .terms-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            width: 100%;
        }

        .terms-header {
            background-color: var(--accent-color);
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .terms-header h3 {
            margin: 0;
            font-weight: 600;
        }

        .last-updated {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .terms-body {
            padding: 30px;
        }

        .terms-section {
            margin-bottom: 30px;
        }

        .terms-section h4 {
            color: var(--accent-color);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .terms-section p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .terms-section ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }

        .terms-section li {
            margin-bottom: 8px;
        }

        .terms-footer {
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
