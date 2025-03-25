@extends('layouts.email')

@section('content')
<div class="email-content">
        // Email notifications
        // Email notifications
        // Email notifications
        // Email notifications
    <h2>{{ $isUpdate ? __('messages.shipmenshipment_update_title') : __('messages.shipmenshipment_notification_title') }}</h2>
    
        // Email notifications
        // Email notifications
    <p>{{ __('messages.shipmenshipment_notification_greeting', ['name' => $shipment->recipient_name]) }}</p>
    
    @if($isUpdate)
    <div class="update-info" style="margin-bottom: 20px; padding: 15px; background-color: var(--background-color); border-left: 4px solid var(--secondary-color); border-radius: 4px;">
        // Email notifications
        // Email notifications
        <h3 style="color: var(--secondary-color); margin-top: 0;">{{ __('messages.shipmenshipment_update_info') }}</h3>
        // Email notifications
        // Email notifications
        <p>{{ __('messages.shipmenshipment_update_message') }}</p>
        
        @if(count($changedFields) > 0)
        <div style="margin-top: 10px;">
        // Email notifications
        // Email notifications
            <p><strong>{{ __('messages.shipmenupdated_fields') }}:</strong></p>
            <ul style="margin-top: 5px; padding-left: 20px;">
                @foreach($changedFields as $field)
                    <li>
                        @if($field == 'origin')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmenorigin') }}
                        @elseif($field == 'destination')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmendestination') }}
                        @elseif($field == 'current_location')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmencurrent_location') }}
                        @elseif($field == 'departure_date')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmendeparture_date') }}
                        @elseif($field == 'estimated_arrival_date')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmenestimated_arrival_date') }}
                        @elseif($field == 'status')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmenstatus') }}
                        @elseif($field == 'additional_info')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmenadditional_info') }}
                        @elseif($field == 'amount')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmenamount') }}
                        @elseif($field == 'payment_method')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmenpayment_method') }}
                        @elseif($field == 'payment_status')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmenpayment_status') }}
                        @elseif($field == 'instructions')
        // Email notifications
        // Email notifications
                            {{ __('messages.shipmenpayment_instructions') }}
                        @else
                            {{ $field }}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    @endif
    
    <div class="shipment-details">
        // Email notifications
        // Email notifications
        <h3>{{ __('messages.shipmenshipment_details') }}</h3>
        
        <table>
            <tr>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmentracking_number') }}:</strong></td>
                <td>{{ $shipment->tracking_number }}</td>
            </tr>
            <tr @if($isUpdate && in_array('origin', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmenorigin') }}:</strong></td>
        // Email notifications
        // Email notifications
                <td>{{ $shipment->origin }} @if($isUpdate && in_array('origin', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('destination', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmendestination') }}:</strong></td>
        // Email notifications
        // Email notifications
                <td>{{ $shipment->destination }} @if($isUpdate && in_array('destination', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('current_location', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmencurrent_location') }}:</strong></td>
        // Email notifications
        // Email notifications
                <td>{{ $shipment->current_location ?: $shipment->origin }} @if($isUpdate && in_array('current_location', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('departure_date', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmendeparture_date') }}:</strong></td>
        // Email notifications
        // Email notifications
                <td>{{ $shipment->departure_date->format('d/m/Y') }} @if($isUpdate && in_array('departure_date', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('estimated_arrival_date', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmenestimated_arrival_date') }}:</strong></td>
        // Email notifications
        // Email notifications
                <td>{{ $shipment->estimated_arrival_date->format('d/m/Y') }} @if($isUpdate && in_array('estimated_arrival_date', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('status', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmenstatus') }}:</strong></td>
        // Email notifications
        // Email notifications
        // Email notifications
        // Email notifications
                <td>{{ __('messages.shipmenshipment_status_' . $shipment->status) }} @if($isUpdate && in_array('status', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            @if($shipment->additional_info)
            <tr @if($isUpdate && in_array('additional_info', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmenadditional_info') }}:</strong></td>
        // Email notifications
        // Email notifications
                <td>{!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($shipment->additional_info))) !!} @if($isUpdate && in_array('additional_info', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            @endif
        </table>
    </div>
    
    @if($shipment->payments->isNotEmpty())
    <div class="payment-details">
        // Email notifications
        // Email notifications
        <h3>{{ __('messages.shipmenpayment_details') }}</h3>
        
        <table>
            @php $payment = $shipment->payments->first(); @endphp
            <tr @if($isUpdate && in_array('amount', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmenamount') }}:</strong></td>
        // Email notifications
        // Email notifications
                <td>{{ $payment->amount }} {{ $payment->currency->code }} @if($isUpdate && in_array('amount', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('payment_method', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmenpayment_method') }}:</strong></td>
        // Email notifications
        // Email notifications
        // Email notifications
        // Email notifications
                <td>{{ __('messages.shipmenpayment_method_' . $payment->payment_method) }} @if($isUpdate && in_array('payment_method', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('payment_status', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmenpayment_status') }}:</strong></td>
        // Email notifications
        // Email notifications
        // Email notifications
        // Email notifications
                <td>{{ __('messages.shipmenpayment_status_' . $payment->status) }} @if($isUpdate && in_array('payment_status', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            @if($payment->instructions)
            <tr @if($isUpdate && in_array('instructions', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
        // Email notifications
        // Email notifications
                <td><strong>{{ __('messages.shipmenpayment_instructions') }}:</strong></td>
        // Email notifications
        // Email notifications
                <td>{!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($payment->instructions))) !!} @if($isUpdate && in_array('instructions', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipmenupdated') }}</span>@endif</td>
            </tr>
            @endif
        </table>
    </div>
    @endif
    
    <div class="tracking-info">
        // Email notifications
        // Email notifications
        <p>{{ __('messages.shipmentrack_shipment_text') }}</p>
        <div class="tracking-button">
            <a href="{{ config('app.url') }}/tracking/{{ $shipment->tracking_number }}" style="display: inline-block; padding: 10px 20px; background-color: var(--secondary-color); color: white; text-decoration: none; border-radius: 5px; margin-top: 10px; font-weight: bold;">
        // Email notifications
        // Email notifications
                {{ __('messages.shipmentrack_shipment_button') }}
            </a>
        </div>
        // Email notifications
        // Email notifications
        <p style="margin-top: 15px;">{{ __('messages.shipmentracking_number') }}: <strong>{{ $shipment->tracking_number }}</strong></p>
    </div>
    
        // Email notifications
        // Email notifications
    <p>{{ __('messages.shipmenshipment_notification_footer') }}</p>
</div>
@endsection