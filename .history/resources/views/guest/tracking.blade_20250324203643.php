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
                                    <div class="info-label">{{ __('messages.shipment_emails.tracking_number') }}</div>
                                    <div class="info-value">{{ $shipment->tracking_number }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.status') }}</div>
                                    <div class="info-value">
                                        <span class="status-badge status-{{ $shipment->status }} fit-content">
                                            {{ __('messages.shipment_emails.shipment_status_' . $shipment->status) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.origin') }}</div>
                                    <div class="info-value">{{ $shipment->origin }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.destination') }}</div>
                                    <div class="info-value">{{ $shipment->destination }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.current_location') }}</div>
                                    <div class="info-value">{{ $shipment->current_location ?: $shipment->origin }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.departure_date') }}</div>
                                    <div class="info-value">{{ $shipment->departure_date->format('d/m/Y') }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.estimated_arrival_date') }}</div>
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
                            <div class="payment-details mt-5">
                                <h4 class="section-title">{{ __('messages.shipment_emails.payment_details') }}</h4>
                                
                                @php $payment = $shipment->payments->first(); @endphp
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.amount') }}</div>
                                    <div class="info-value">{{ number_format($payment->amount, 2) }} {{ $payment->currency->symbol }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.payment_method') }}</div>
                                    <div class="info-value">{{ __('messages.shipment_emails.payment_method_' . $payment->payment_method) }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">{{ __('messages.shipment_emails.payment_status') }}</div>
                                    <div class="info-value">
                                        <span class="status-badge payment-status-{{ $payment->status }} fit-content">
                                            {{ __('messages.shipment_emails.payment_status_' . $payment->status) }}
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
        /* Additional styles for tracking page */
        .tracking-details.section {
            margin: 60px 0;
            padding: 30px 0;
        }
        
        .tracking-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            width: 100%;
        }
        
        .tracking-header {
            background-color: var(--accent-color);
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .tracking-header h3 {
            margin: 0;
            font-weight: 600;
        }
        
        .tracking-number {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 5px 10px;
            border-radius: 5px;
            font-family: monospace;
            font-weight: bold;
        }
        
        .tracking-body {
            padding: 30px;
        }
        
        .section-title {
            color: var(--accent-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 15px;
        }
        
        .info-label {
            width: 40%;
            font-weight: 600;
            color: #555;
        }
        
        .info-value {
            width: 60%;
        }
        
        .fit-content {
            width: fit-content !important;
            display: inline-block !important;
        }
        
        .formatted-text {
            white-space: pre-line;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border-left: 3px solid var(--accent-color);
        }
        
        .formatted-text strong {
            font-weight: bold;
            color: var(--accent-color);
        }
        
        .formatted-text em {
            font-style: italic;
        }
        
        .formatted-text u {
            text-decoration: underline;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
        }
        
        .status-processing {
            background-color: #e3f2fd;
            color: #0d47a1;
        }
        
        .status-in_transit {
            background-color: #e8f5e9;
            color: #1b5e20;
        }
        
        .status-out_for_delivery {
            background-color: #fff8e1;
            color: #ff6f00;
        }
        
        .status-delivered {
            background-color: #e8f5e9;
            color: #1b5e20;
        }
        
        .status-delayed {
            background-color: #ffebee;
            color: #b71c1c;
        }
        
        .status-exception {
            background-color: #ffebee;
            color: #b71c1c;
        }
        
        .payment-status-pending {
            background-color: #fff8e1;
            color: #ff6f00;
        }
        
        .payment-status-paid {
            background-color: #e8f5e9;
            color: #1b5e20;
        }
        
        .payment-status-failed {
            background-color: #ffebee;
            color: #b71c1c;
        }
        
        .tracking-footer {
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
        
        .payment-details {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
@endsection