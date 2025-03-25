@extends('layouts.email')

@section('content')
<div class="email-content">
    <h2>{{ $isUpdate ? __('messages.shipment_update_title') : __('messages.shipment_notification_title') }}</h2>
    
    <p>{{ __('messages.shipment_notification_greeting', ['name' => $shipment->recipient_name]) }}</p>
    
    @if($isUpdate)
    <div class="update-info" style="margin-bottom: 20px; padding: 15px; background-color: var(--background-color); border-left: 4px solid var(--secondary-color); border-radius: 4px;">
        <h3 style="color: var(--secondary-color); margin-top: 0;">{{ __('messages.shipment_update_info') }}</h3>
        <p>{{ __('messages.shipment_update_message') }}</p>
        
        @if(count($changedFields) > 0)
        <div style="margin-top: 10px;">
            <p><strong>{{ __('messages.updated_fields') }}:</strong></p>
            <ul style="margin-top: 5px; padding-left: 20px;">
                @foreach($changedFields as $field)
                    <li>
                        @if($field == 'origin')
                            {{ __('messages.origin') }}
                        @elseif($field == 'destination')
                            {{ __('messages.destination') }}
                        @elseif($field == 'current_location')
                            {{ __('messages.current_location') }}
                        @elseif($field == 'departure_date')
                            {{ __('messages.departure_date') }}
                        @elseif($field == 'estimated_arrival_date')
                            {{ __('messages.estimated_arrival_date') }}
                        @elseif($field == 'status')
                            {{ __('messages.status') }}
                        @elseif($field == 'additional_info')
                            {{ __('messages.additional_info') }}
                        @elseif($field == 'amount')
                            {{ __('messages.amount') }}
                        @elseif($field == 'payment_method')
                            {{ __('messages.payment_method') }}
                        @elseif($field == 'payment_status')
                            {{ __('messages.payment_status') }}
                        @elseif($field == 'instructions')
                            {{ __('messages.payment_instructions') }}
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
        <h3>{{ __('messages.shipment_details') }}</h3>
        
        <table>
            <tr>
                <td><strong>{{ __('messages.tracking_number') }}:</strong></td>
                <td>{{ $shipment->tracking_number }}</td>
            </tr>
            <tr @if($isUpdate && in_array('origin', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.origin') }}:</strong></td>
                <td>{{ $shipment->origin }} @if($isUpdate && in_array('origin', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('destination', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.destination') }}:</strong></td>
                <td>{{ $shipment->destination }} @if($isUpdate && in_array('destination', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('current_location', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.current_location') }}:</strong></td>
                <td>{{ $shipment->current_location ?: $shipment->origin }} @if($isUpdate && in_array('current_location', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('departure_date', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.departure_date') }}:</strong></td>
                <td>{{ $shipment->departure_date->format('d/m/Y') }} @if($isUpdate && in_array('departure_date', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('estimated_arrival_date', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.estimated_arrival_date') }}:</strong></td>
                <td>{{ $shipment->estimated_arrival_date->format('d/m/Y') }} @if($isUpdate && in_array('estimated_arrival_date', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('status', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.status') }}:</strong></td>
                <td>{{ __('messages.shipment_status_' . $shipment->status) }} @if($isUpdate && in_array('status', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            @if($shipment->additional_info)
            <tr @if($isUpdate && in_array('additional_info', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.additional_info') }}:</strong></td>
                <td>{!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($shipment->additional_info))) !!} @if($isUpdate && in_array('additional_info', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            @endif
        </table>
    </div>
    
    @if($shipment->payments->isNotEmpty())
    <div class="payment-details">
        <h3>{{ __('messages.payment_details') }}</h3>
        
        <table>
            @php $payment = $shipment->payments->first(); @endphp
            <tr @if($isUpdate && in_array('amount', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.amount') }}:</strong></td>
                <td>{{ $payment->amount }} {{ $payment->currency->code }} @if($isUpdate && in_array('amount', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('payment_method', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.payment_method') }}:</strong></td>
                <td>{{ __('messages.payment_method_' . $payment->payment_method) }} @if($isUpdate && in_array('payment_method', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            <tr @if($isUpdate && in_array('payment_status', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.payment_status') }}:</strong></td>
                <td>{{ __('messages.payment_status_' . $payment->status) }} @if($isUpdate && in_array('payment_status', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            @if($payment->instructions)
            <tr @if($isUpdate && in_array('instructions', $changedFields)) style="background-color: var(--background-color); font-weight: bold;" @endif>
                <td><strong>{{ __('messages.payment_instructions') }}:</strong></td>
                <td>{!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($payment->instructions))) !!} @if($isUpdate && in_array('instructions', $changedFields))<span style="color: var(--secondary-color); font-size: 0.8em; margin-left: 5px;">{{ __('messages.updated') }}</span>@endif</td>
            </tr>
            @endif
        </table>
    </div>
    @endif
    
    <div class="tracking-info">
        <p>{{ __('messages.track_shipment_text') }}</p>
        <div class="tracking-button">
            <a href="{{ config('app.url') }}/tracking/{{ $shipment->tracking_number }}" style="display: inline-block; padding: 10px 20px; background-color: var(--secondary-color); color: white; text-decoration: none; border-radius: 5px; margin-top: 10px; font-weight: bold;">
                {{ __('messages.track_shipment_button') }}
            </a>
        </div>
        <p style="margin-top: 15px;">{{ __('messages.tracking_number') }}: <strong>{{ $shipment->tracking_number }}</strong></p>
    </div>
    
    <p>{{ __('messages.shipment_notification_footer') }}</p>
</div>
@endsection