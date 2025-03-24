<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shipment;
use App\Models\Currency;
use App\Models\Payment;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ManageShipments extends Component
{
    use WithPagination;

    public $showForm = false;
    public $showDeleteConfirmation = false;
    public $shipmentIdToDelete = null;
    public $tracking_number;
    public $origin;
    public $destination;
    public $current_location;
    public $departure_date;
    public $estimated_arrival_date;
    public $status = 'processing';
    public $recipient_name;
    public $recipient_email;
    public $sender_name;
    public $locale = 'fr';

    // Payment fields
    public $amount;
    public $currency_id;
    public $percentage = 100;
    public $payment_method;
    public $instructions;
    public $payment_status = 'pending';
    
    public $shipmentId;
    public $isEditing = false;
    
    protected $rules = [
        'tracking_number' => 'required|string|unique:shipments,tracking_number',
        'origin' => 'required|string',
        'destination' => 'required|string',
        'current_location' => 'nullable|string',
        'departure_date' => 'required|date',
        'estimated_arrival_date' => 'required|date|after_or_equal:departure_date',
        'status' => 'required|in:processing,in_transit,out_for_delivery,delivered,delayed,exception',
        'recipient_name' => 'required|string',
        'recipient_email' => 'required|email',
        'sender_name' => 'required|string',
        'locale' => 'required|string|in:fr,en,es,de', // Add available locales
    
        // Payment validation
        'amount' => 'required|numeric|min:0',
        'currency_id' => 'required|exists:currencies,id',
        'percentage' => 'required|integer|min:10|max:100',
        'payment_method' => 'required|string',
        'instructions' => 'nullable|string',
        'payment_status' => 'required|in:pending,paid,failed',
    ];
    
    public function mount()
    {
        $this->tracking_number = 'TRK' . strtoupper(Str::random(8));
    }
    
    /**
     * Toggle the form visibility
     */
    public function toggleForm()
    {
        // If we're closing the form, reset everything
        if ($this->showForm) {
            $this->cancelForm();
        } else {
            // Just show the form for a new entry
            $this->showForm = true;
            $this->isEditing = false;
            $this->shipmentId = null;
            
            // Reset the form fields for a new entry
            $this->reset([
                'tracking_number', 'origin', 'destination', 'current_location',
                'departure_date', 'estimated_arrival_date', 'status',
                'recipient_name', 'recipient_email', 'sender_name', 'locale',
                'amount', 'currency_id', 'percentage', 'payment_method',
                'payment_status', 'instructions'
            ]);
            
            // Set default values if needed
            $this->status = 'processing';
            $this->payment_status = 'pending';
            $this->locale = 'fr'; // Or your default locale
            $this->tracking_number = 'TRK' . strtoupper(Str::random(8));
        }
    }
    
    public function resetForm()
    {
        $this->reset([
            'origin', 'destination', 'current_location', 'departure_date', 
            'estimated_arrival_date', 'status', 'recipient_name', 'sender_name',
            'amount', 'currency_id', 'percentage', 'payment_method', 
            'instructions', 'payment_status', 'isEditing', 'shipmentId'
        ]);
        
        $this->tracking_number = 'TRK' . strtoupper(Str::random(8));
    }
    
    public function saveShipment()
    {
        if ($this->isEditing) {
            $this->rules['tracking_number'] = 'required|string|unique:shipments,tracking_number,' . $this->shipmentId;
        }
        
        $this->validate();
        
        try {
            // Create or update shipment
            $shipmentData = [
                'tracking_number' => $this->tracking_number,
                'origin' => $this->origin,
                'destination' => $this->destination,
                'current_location' => $this->current_location,
                'departure_date' => $this->departure_date,
                'estimated_arrival_date' => $this->estimated_arrival_date,
                'status' => $this->status,
                'recipient_name' => $this->recipient_name,
                'recipient_email' => $this->recipient_email,
                'sender_name' => $this->sender_name,
                'locale' => $this->locale,
                'history' => [
                    [
                        'date' => now()->format('Y-m-d H:i:s'),
                        'status' => $this->status,
                        'location' => $this->current_location ?: $this->origin,
                        'description' => 'Shipment registered'
                    ]
                ]
            ];
            
            if ($this->isEditing) {
                $shipment = Shipment::findOrFail($this->shipmentId);
                $shipment->update($shipmentData);
            } else {
                $shipment = Shipment::create($shipmentData);
            }
            
            // Create payment
            $paymentData = [
                'shipment_id' => $shipment->id,
                'currency_id' => $this->currency_id,
                'amount' => $this->amount,
                'percentage' => $this->percentage,
                'payment_method' => $this->payment_method,
                'instructions' => $this->instructions,
                'status' => $this->payment_status,
                'paid_at' => $this->payment_status === 'paid' ? now() : null,
            ];
            
            if ($this->isEditing) {
                $payment = Payment::where('shipment_id', $shipment->id)->first();
                if ($payment) {
                    $payment->update($paymentData);
                } else {
                    Payment::create($paymentData);
                }
            } else {
                Payment::create($paymentData);
            }
            
            $this->dispatch('shipment-saved', [
                'message' => $this->isEditing ? 'Expédition mise à jour avec succès!' : 'Nouvelle expédition créée avec succès!'
            ]);
            
            $this->resetForm();
            $this->showForm = false;
        } catch (\Exception $e) {
            $this->dispatch('shipment-error', [
                'message' => 'Erreur: ' . $e->getMessage()
            ]);
        }
    }
    
    public function editShipment($id)
    {
        $shipment = Shipment::with('payments')->findOrFail($id);
        $payment = $shipment->payments->first();
        
        $this->shipmentId = $shipment->id;
        $this->tracking_number = $shipment->tracking_number;
        $this->origin = $shipment->origin;
        $this->destination = $shipment->destination;
        $this->current_location = $shipment->current_location;
        $this->departure_date = $shipment->departure_date->format('Y-m-d');
        $this->estimated_arrival_date = $shipment->estimated_arrival_date->format('Y-m-d');
        $this->status = $shipment->status;
        $this->recipient_name = $shipment->recipient_name;
        $this->recipient_email = $shipment->recipient_email;
        $this->sender_name = $shipment->sender_name;
        
        if ($payment) {
            $this->amount = $payment->amount;
            $this->currency_id = $payment->currency_id;
            $this->percentage = $payment->percentage;
            $this->payment_method = $payment->payment_method;
            $this->instructions = $payment->instructions;
            $this->payment_status = $payment->status;
        }
        
        $this->isEditing = true;
        $this->showForm = true;
    }
    
    // New methods for delete confirmation
    public function showDeleteModal($id)
    {
        $this->shipmentIdToDelete = $id;
        $this->showDeleteConfirmation = true;
    }
    
    public function cancelDelete()
    {
        $this->showDeleteConfirmation = false;
        $this->shipmentIdToDelete = null;
    }
    
    public function confirmDelete()
    {
        try {
            $shipment = Shipment::findOrFail($this->shipmentIdToDelete);
            $shipment->delete();
            
            $this->dispatch('shipment-saved', [
                'message' => 'Expédition supprimée avec succès!'
            ]);
            
            $this->showDeleteConfirmation = false;
            $this->shipmentIdToDelete = null;
        } catch (\Exception $e) {
            $this->dispatch('shipment-error', [
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ]);
        }
    }
    
    public function deleteShipment($id)
    {
        $this->showDeleteModal($id);
    }
    
    /**
     * Cancel the form and reset all states
     */
    public function cancelForm()
    {
        // Reset the form
        $this->reset([
            'tracking_number', 'origin', 'destination', 'current_location',
            'departure_date', 'estimated_arrival_date', 'status',
            'recipient_name', 'recipient_email', 'sender_name', 'locale',
            'amount', 'currency_id', 'percentage', 'payment_method',
            'payment_status', 'instructions'
        ]);
        
        // Reset editing state
        $this->isEditing = false;
        $this->shipmentId = null;
        
        // Hide the form
        $this->showForm = false;
        
        // Generate new tracking number
        $this->tracking_number = 'TRK' . strtoupper(Str::random(8));
    }
    
    public function render()
    {
        return view('livewire.manage-shipments', [
            'shipments' => Shipment::with('payments.currency')->latest()->paginate(10),
            'currencies' => Currency::all(),
            'paymentMethods' => [
                'bank_transfer' => 'Virement bancaire',
                'credit_card' => 'Carte de crédit',
                'paypal' => 'PayPal',
                'cash_on_delivery' => 'Espèces à la livraison',
                'check' => 'Chèque',
            ],
            'percentageOptions' => [10, 25, 50, 75, 100],
            'availableLocales' => $this->getAvailableLocales(),
        ]);
    }

    protected function getAvailableLocales()
    {
        $locales = [];
        $langPath = base_path('lang');
        
        foreach (scandir($langPath) as $locale) {
            if ($locale !== '.' && $locale !== '..' && is_dir($langPath . '/' . $locale)) {
                $locales[$locale] = strtoupper($locale);
            }
        }
        
        return $locales;
    }
}