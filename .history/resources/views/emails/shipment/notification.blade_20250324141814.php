@extends('layouts.email')

@section('content')
<div class="email-content">
    <h2>{{ __('messages.shipment_notification_title') }}</h2>
    
    <p>{{ __('messages.shipment_notification_greeting', ['name' => $shipment->recipient_name]) }}</p>
    
    <div class="shipment-details">
        <h3>{{ __('messages.shipment_details') }}</h3>
        
        <table>
            <tr>
                <td><strong>{{ __('messages.tracking_number') }}:</strong></td>
                <td>{{ $shipment->tracking_number }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('messages.origin') }}:</strong></td>
                <td>{{ $shipment->origin }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('messages.destination') }}:</strong></td>
                <td>{{ $shipment->destination }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('messages.current_location') }}:</strong></td>
                <td>{{ $shipment->current_location ?: $shipment->origin }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('messages.departure_date') }}:</strong></td>
                <td>{{ $shipment->departure_date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('messages.estimated_arrival_date') }}:</strong></td>
                <td>{{ $shipment->estimated_arrival_date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('messages.status') }}:</strong></td>
                <td>{{ __('messages.shipment_status_' . $shipment->status) }}</td>
            </tr>
            @if($shipment->additional_info)
            <tr>
                <td><strong>{{ __('messages.additional_info') }}:</strong></td>
                <td>{!! nl2br(e($shipment->additional_info)) !!}</td>
            </tr>
            @endif
        </table>
    </div>
    
    @if($shipment->payments->isNotEmpty())
    <div class="payment-details">
        <h3>{{ __('messages.payment_details') }}</h3>
        
        <table>
            @php $payment = $shipment->payments->first(); @endphp
            <tr>
                <td><strong>{{ __('messages.amount') }}:</strong></td>
                <td>{{ $payment->amount }} {{ $payment->currency->code }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('messages.payment_method') }}:</strong></td>
                <td>{{ __('messages.payment_method_' . $payment->payment_method) }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('messages.payment_status') }}:</strong></td>
                <td>{{ __('messages.payment_status_' . $payment->status) }}</td>
            </tr>
            @if($payment->instructions)
            <tr>
                <td><strong>{{ __('messages.payment_instructions') }}:</strong></td>
                <td>{!! nl2br(e($payment->instructions)) !!}</td>
            </tr>
            @endif
        </table>
    </div>
    @endif
    
    <div class="tracking-info">
        <p>{{ __('messages.track_shipment_text') }}</p>
        <p>{{ __('messages.tracking_number') }}: <strong>{{ $shipment->tracking_number }}</strong></p>
    </div>
    
    <p>{{ __('messages.shipment_notification_footer') }}</p>
</div>
@endsection