@extends('layouts.custom-guest')

@section('content')
    @include('components.page-title', ['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription])

    <section class="tracking-details section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="tracking-card">
                        <div class="tracking-header">
                            <h3>{{ __('messages.tracking.shipment_details') }}</h3>
                            <span class="tracking-number">{{ $shipment->tracking_number }}</span>
                        </div>
                        
                        <div class="tracking-body">
                            <div class="tracking-info">
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.status') }}</div>
                                    <div class="info-value">
                                        <span class="status-badge status-{{ $shipment->status }} fit-content">
                                            {{ __('messages.shipment_status_' . $shipment->status) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.origin') }}</div>
                                    <div class="info-value">{{ $shipment->origin }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.destination') }}</div>
                                    <div class="info-value">{{ $shipment->destination }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.current_location') }}</div>
                                    <div class="info-value">{{ $shipment->current_location ?: $shipment->origin }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.departure_date') }}</div>
                                    <div class="info-value">{{ $shipment->departure_date->format('d/m/Y') }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.estimated_arrival') }}</div>
                                    <div class="info-value">{{ $shipment->estimated_arrival_date->format('d/m/Y') }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.recipient') }}</div>
                                    <div class="info-value">{{ $shipment->recipient_name }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.recipient_email') }}</div>
                                    <div class="info-value">{{ $shipment->recipient_email }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.sender') }}</div>
                                    <div class="info-value">{{ $shipment->sender_name }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.locale') }}</div>
                                    <div class="info-value">{{ strtoupper($shipment->locale) }}</div>
                                </div>
                                
                                @if($shipment->additional_info)
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.additional_info') }}</div>
                                    <div class="info-value formatted-text">
                                        {!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($shipment->additional_info))) !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            @if($shipment->payments->isNotEmpty())
                            <div class="payment-details mt-4">
                                <h4>{{ __('messages.tracking.payment_details') }}</h4>
                                
                                @php $payment = $shipment->payments->first(); @endphp
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.amount') }}</div>
                                    <div class="info-value">{{ number_format($payment->amount, 2) }} {{ $payment->currency->symbol }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.payment_method') }}</div>
                                    <div class="info-value">{{ __('messages.payment_method_' . $payment->payment_method) }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.payment_status') }}</div>
                                    <div class="info-value">
                                        <span class="status-badge payment-status-{{ $payment->status }} fit-content">
                                            {{ __('messages.payment_status_' . $payment->status) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.percentage') }}</div>
                                    <div class="info-value">{{ $payment->percentage }}%</div>
                                </div>
                                
                                @if($payment->paid_at)
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.paid_at') }}</div>
                                    <div class="info-value">{{ $payment->paid_at->format('d/m/Y H:i') }}</div>
                                </div>
                                @endif
                                
                                @if($payment->instructions)
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.tracking.payment_instructions') }}</div>
                                    <div class="info-value formatted-text">
                                        {!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($payment->instructions))) !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                        
                        <div class="tracking-footer">
                            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left"></i> {{ __('messages.tracking.back_home') }}
                            </a>
                            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">
                                {{ __('messages.tracking.contact_us') }} <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Additional styles for tracking page */
        .tracking-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            width: 100%;
        }
        
        .fit-content {
            width: fit-content !important;
            display: inline-block !important;
        }
        
        .formatted-text {
            white-space: pre-line;
        }
        
        .formatted-text strong {
            font-weight: bold;
        }
        
        .formatted-text em {
            font-style: italic;
        }
        
        .formatted-text u {
            text-decoration: underline;
        }
    </style>
@endsection