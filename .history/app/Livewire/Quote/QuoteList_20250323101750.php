<?php

namespace App\Livewire\Quote;

use App\Models\Quote;
use Livewire\Component;
use Livewire\WithPagination;

class QuoteList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $isUpdatingStatus = false;

    protected $listeners = ['filter-updated' => 'applyFilters'];

    public function applyFilters($filters)
    {
        $this->search = $filters['search'];
        $this->statusFilter = $filters['statusFilter'];
        $this->sortField = $filters['sortField'];
        $this->sortDirection = $filters['sortDirection'];
    }

    public function updateStatus(Quote $quote, $status)
    {
        $this->isUpdatingStatus = true;

        try {
            $quote->status = $status;
            $quote->save();

            $this->dispatch('quote-updated', [
                'message' => "Statut mis à jour avec succès.",
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('quote-update-failed', [
                'message' => "Erreur lors de la mise à jour du statut: " . $e->getMessage(),
                'type' => 'error'
            ]);
        } finally {
            $this->isUpdatingStatus = false;
        }
    }

    public function showDetails($quoteId)
    {
        $this->dispatch('show-quote-details', ['quoteId' => $quoteId]);
    }

    public function render()
    {
        $quotes = Quote::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('company', 'like', '%' . $this->search . '%')
                        ->orWhere('service_type', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                return $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.quote.quote-list', [
            'quotes' => $quotes
        ]);
    }
}
