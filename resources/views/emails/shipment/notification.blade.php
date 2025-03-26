@extends('layouts.email')
@section('content')
    <div style="text-align: center;">
        <h1>{{ $isUpdate ? __('messages.shipment_emails.shipment_update_title') : __('messages.shipment_emails.shipment_notification_title') }}
        </h1>

        <p>{{ __('messages.shipment_emails.shipment_notification_greeting', ['name' => $shipment->recipient_name]) }}</p>

        @if ($isUpdate)
            <div style="margin: 20px 0; padding: 15px; border-left: 4px solid #00A7E1;">
                <h3 style="color: #00A7E1; margin-top: 0;">{{ __('messages.shipment_emails.shipment_update_info') }}</h3>
                <p>{{ __('messages.shipment_emails.shipment_update_message') }}</p>

                @if (count($changedFields) > 0)
                    <div style="margin-top: 10px; text-align: left;">
                        <p><strong>{{ __('messages.shipment_emails.updated_fields') }}:</strong></p>
                        <ul style="margin-top: 5px; padding-left: 20px;">
                            @foreach ($changedFields as $field)
                                <li>
                                    @if ($field == 'origin')
                                        {{ __('messages.shipment_emails.origin') }}
                                    @elseif($field == 'destination')
                                        {{ __('messages.shipment_emails.destination') }}
                                    @elseif($field == 'current_location')
                                        {{ __('messages.shipment_emails.current_location') }}
                                    @elseif($field == 'departure_date')
                                        {{ __('messages.shipment_emails.departure_date') }}
                                    @elseif($field == 'estimated_arrival_date')
                                        {{ __('messages.shipment_emails.estimated_arrival_date') }}
                                    @elseif($field == 'status')
                                        {{ __('messages.shipment_emails.status') }}
                                    @elseif($field == 'additional_info')
                                        {{ __('messages.shipment_emails.additional_info') }}
                                    @elseif($field == 'amount')
                                        {{ __('messages.shipment_emails.amount') }}
                                    @elseif($field == 'payment_method')
                                        {{ __('messages.shipment_emails.payment_method') }}
                                    @elseif($field == 'payment_status')
                                        {{ __('messages.shipment_emails.payment_status') }}
                                    @elseif($field == 'instructions')
                                        {{ __('messages.shipment_emails.payment_instructions') }}
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

        <div style="text-align: left;">
            <h2>{{ __('messages.shipment_emails.shipment_details') }}</h2>

            <table>
                <tr>
                    <th>{{ __('messages.shipment_emails.tracking_number') }}</th>
                    <td>{{ $shipment->tracking_number }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.shipment_emails.origin') }}</th>
                    <td>
                        {{ $shipment->origin }}
                        @if ($isUpdate && in_array('origin', $changedFields))
                            <span
                                style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('messages.shipment_emails.destination') }}</th>
                    <td>
                        {{ $shipment->destination }}
                        @if ($isUpdate && in_array('destination', $changedFields))
                            <span
                                style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('messages.shipment_emails.current_location') }}</th>
                    <td>
                        {{ $shipment->current_location ?: $shipment->origin }}
                        @if ($isUpdate && in_array('current_location', $changedFields))
                            <span
                                style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('messages.shipment_emails.departure_date') }}</th>
                    <td>
                        {{ $shipment->departure_date->format('d/m/Y') }}
                        @if ($isUpdate && in_array('departure_date', $changedFields))
                            <span
                                style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('messages.shipment_emails.estimated_arrival_date') }}</th>
                    <td>
                        {{ $shipment->estimated_arrival_date->format('d/m/Y') }}
                        @if ($isUpdate && in_array('estimated_arrival_date', $changedFields))
                            <span
                                style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('messages.shipment_emails.status') }}</th>
                    <td>
                        {{ __('messages.shipment_emails.shipment_status_' . $shipment->status) }}
                        @if ($isUpdate && in_array('status', $changedFields))
                            <span
                                style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                        @endif
                    </td>
                </tr>
                @if ($shipment->additional_info)
                    <tr>
                        <th>{{ __('messages.shipment_emails.additional_info') }}</th>
                        <td>
                            {!! nl2br(e($shipment->additional_info)) !!}
                            @if ($isUpdate && in_array('additional_info', $changedFields))
                                <span
                                    style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                            @endif
                        </td>
                    </tr>
                @endif
            </table>
        </div>

        @if ($shipment->payments->isNotEmpty())
            <div style="text-align: left; margin-top: 30px;">
                <h2>{{ __('messages.shipment_emails.payment_details') }}</h2>

                <table>
                    @php $payment = $shipment->payments->first(); @endphp
                    <tr>
                        <th>{{ __('messages.shipment_emails.amount') }}</th>
                        <td>
                            {{ $payment->amount }} {{ $payment->currency->code }}
                            @if ($isUpdate && in_array('amount', $changedFields))
                                <span
                                    style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('messages.shipment_emails.payment_method') }}</th>
                        <td>
                            {{ __('messages.shipment_emails.payment_method_' . $payment->payment_method) }}
                            @if ($isUpdate && in_array('payment_method', $changedFields))
                                <span
                                    style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('messages.shipment_emails.payment_status') }}</th>
                        <td>
                            {{ __('messages.shipment_emails.payment_status_' . $payment->status) }}
                            @if ($isUpdate && in_array('payment_status', $changedFields))
                                <span
                                    style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                            @endif
                        </td>
                    </tr>
                    @if ($payment->instructions)
                        <tr>
                            <th>{{ __('messages.shipment_emails.payment_instructions') }}</th>
                            <td>
                                {!! nl2br(e($payment->instructions)) !!}
                                @if ($isUpdate && in_array('instructions', $changedFields))
                                    <span
                                        style="color: #00A7E1; font-size: 0.8em; margin-left: 5px;">{{ __('messages.shipment_emails.updated') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        @endif

        <div style="text-align: center; margin-top: 30px;">
            <p>{{ __('messages.shipment_emails.track_shipment_text') }}</p>
            <p>
                <a href="{{ route('shipment.track', ['locale' => app()->getLocale(), 'shipment' => $shipment->tracking_number]) }}"
                    class="text-white no-underline hover:text-gray-200 transition-colors duration-200">
                    {{ __('messages.shipment_emails.track_shipment_button') }}
                </a>
            </p>
            <p style="margin-top: 15px;">{{ __('messages.shipment_emails.tracking_number') }}:
                <strong>{{ $shipment->tracking_number }}</strong>
            </p>
        </div>

        <p style="margin-top: 30px;">{{ __('messages.shipment_emails.shipment_notification_footer') }}</p>
    </div>
@endsection
