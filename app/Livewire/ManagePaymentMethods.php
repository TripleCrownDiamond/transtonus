<?php

namespace App\Livewire;

use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePaymentMethods extends Component
{
    use WithPagination;

    // Form properties
    public $name;
    public $code;
    public $description;
    public $is_active = true;
    
    // State properties
    public $showForm = false;
    public $isEditing = false;
    public $paymentMethodId = null;
    public $showDeleteConfirmation = false;
    public $paymentMethodIdToDelete = null;

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50',
        'description' => 'nullable|string',
        'is_active' => 'boolean',
    ];

    /**
     * Reset form fields
     */
    public function resetFormFields()
    {
        $this->reset(['name', 'code', 'description', 'is_active', 'isEditing', 'paymentMethodId']);
        $this->resetValidation();
    }

    /**
     * Toggle form visibility
     */
    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        if (!$this->showForm) {
            $this->resetFormFields();
        }
    }

    /**
     * Cancel form editing
     */
    public function cancelForm()
    {
        $this->showForm = false;
        $this->resetFormFields();
    }

    /**
     * Edit payment method
     */
    public function editPaymentMethod($id)
    {
        $this->isEditing = true;
        $this->paymentMethodId = $id;
        $this->showForm = true;
        
        $paymentMethod = PaymentMethod::findOrFail($id);
        $this->name = $paymentMethod->name;
        $this->code = $paymentMethod->code;
        $this->description = $paymentMethod->description;
        $this->is_active = $paymentMethod->is_active;
    }

    /**
     * Save payment method (create or update)
     */
    public function savePaymentMethod()
    {
        $this->validate();
        
        try {
            if ($this->isEditing) {
                $paymentMethod = PaymentMethod::findOrFail($this->paymentMethodId);
                $message = 'Méthode de paiement mise à jour avec succès!';
            } else {
                $paymentMethod = new PaymentMethod();
                $message = 'Méthode de paiement créée avec succès!';
            }
            
            $paymentMethod->name = $this->name;
            $paymentMethod->code = $this->code;
            $paymentMethod->description = $this->description;
            $paymentMethod->is_active = $this->is_active;
            $paymentMethod->save();
            
            $this->dispatch('payment-method-saved', [
                'message' => $message
            ]);
            
            $this->showForm = false;
            $this->resetFormFields();
        } catch (\Exception $e) {
            $this->dispatch('payment-method-error', [
                'message' => 'Erreur lors de l\'enregistrement: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Show delete confirmation modal
     */
    public function showDeleteModal($id)
    {
        $this->paymentMethodIdToDelete = $id;
        $this->showDeleteConfirmation = true;
    }
    
    /**
     * Cancel delete operation
     */
    public function cancelDelete()
    {
        $this->paymentMethodIdToDelete = null;
        $this->showDeleteConfirmation = false;
    }
    
    /**
     * Confirm and execute delete operation
     */
    public function confirmDelete()
    {
        try {
            $paymentMethod = PaymentMethod::findOrFail($this->paymentMethodIdToDelete);
            $paymentMethod->delete();
            
            $this->dispatch('payment-method-saved', [
                'message' => 'Méthode de paiement supprimée avec succès!'
            ]);
            
            $this->cancelDelete();
        } catch (\Exception $e) {
            $this->dispatch('payment-method-error', [
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.manage-payment-methods', [
            'paymentMethods' => PaymentMethod::paginate(10)
        ]);
    }
}