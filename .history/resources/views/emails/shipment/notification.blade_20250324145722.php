@extends('layouts.email')

@section('content')
<div class="email-content">
    <h2>{{ $isUpdate ? __('messages.shipment_update_title') : __('messages.shipment_notification_title') }}</h2>
    
    <p>{{ __('messages.shipment_notification_greeting', ['name' => $shipment->recipient_name]) }}</p>
    
    @if($isUpdate)
    <div class="update-info">
        <h3>{{ __('messages.shipment_update_info') }}</h3>
        <p>{{ __('messages.shipment_update_message') }}</p>
    </div>
    @endif
    
    <div class="shipment-details">
        <h3>{{ __('messages.shipment_details') }}</h3>
        
        <table>
            <tr>
                <td><strong>{{ __('messages.tracking_number') }}:</strong></td>
                <td>{{ $shipment->tracking_number }}</td>
            </tr>
            <tr @if($isUpdate && in_array('origin', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.origin') }}:</strong></td>
                <td>{{ $shipment->origin }}</td>
            </tr>
            <tr @if($isUpdate && in_array('destination', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.destination') }}:</strong></td>
                <td>{{ $shipment->destination }}</td>
            </tr>
            <tr @if($isUpdate && in_array('current_location', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.current_location') }}:</strong></td>
                <td>{{ $shipment->current_location ?: $shipment->origin }}</td>
            </tr>
            <tr @if($isUpdate && in_array('departure_date', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.departure_date') }}:</strong></td>
                <td>{{ $shipment->departure_date->format('d/m/Y') }}</td>
            </tr>
            <tr @if($isUpdate && in_array('estimated_arrival_date', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.estimated_arrival_date') }}:</strong></td>
                <td>{{ $shipment->estimated_arrival_date->format('d/m/Y') }}</td>
            </tr>
            <tr @if($isUpdate && in_array('status', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.status') }}:</strong></td>
                <td>{{ __('messages.shipment_status_' . $shipment->status) }}</td>
            </tr>
            @if($shipment->additional_info)
            <tr @if($isUpdate && in_array('additional_info', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.additional_info') }}:</strong></td>
                <td>{!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($shipment->additional_info))) !!}</td>
            </tr>
            @endif
        </table>
    </div>
    
    @if($shipment->payments->isNotEmpty())
    <div class="payment-details">
        <h3>{{ __('messages.payment_details') }}</h3>
        
        <table>
            @php $payment = $shipment->payments->first(); @endphp
            <tr @if($isUpdate && in_array('amount', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.amount') }}:</strong></td>
                <td>{{ $payment->amount }} {{ $payment->currency->code }}</td>
            </tr>
            <tr @if($isUpdate && in_array('payment_method', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.payment_method') }}:</strong></td>
                <td>{{ __('messages.payment_method_' . $payment->payment_method) }}</td>
            </tr>
            <tr @if($isUpdate && in_array('payment_status', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.payment_status') }}:</strong></td>
                <td>{{ __('messages.payment_status_' . $payment->status) }}</td>
            </tr>
            @if($payment->instructions)
            <tr @if($isUpdate && in_array('instructions', $changedFields)) class="updated-field" style="background-color: #ffffcc;" @endif>
                <td><strong>{{ __('messages.payment_instructions') }}:</strong></td>
                <td>{!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($payment->instructions))) !!}</td>
            </tr>
            @endif
        </table>
    </div>
    @endif
    
    <div class="tracking-info">
        <p>{{ __('messages.track_shipment_text') }}</p>
        <div class="tracking-button">
            <a href="{{ config('app.url') }}/tracking/{{ $shipment->tracking_number }}" class="button" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px;">
                {{ __('messages.track_shipment_button') }}
            </a>
        </div>
        <p style="margin-top: 15px;">{{ __('messages.tracking_number') }}: <strong>{{ $shipment->tracking_number }}</strong></p>
    </div>
    
    <p>{{ __('messages.shipment_notification_footer') }}</p>
</div>
@endsection