<?php

namespace App\Livewire\Quote;

use Livewire\Component;

class Filters extends Component
{
    public $search = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function mount($search = '', $statusFilter = '', $sortField = 'created_at', $sortDirection = 'desc')
    {
        $this->search = $search;
        $this->statusFilter = $statusFilter;
        $this->sortField = $sortField;
        $this->sortDirection = $sortDirection;
    }

    public function updatedSearch()
    {
        $this->dispatch('filter-updated', [
            'search' => $this->search,
            'statusFilter' => $this->statusFilter,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection
        ]);
    }

    public function updatedStatusFilter()
    {
        $this->dispatch('filter-updated', [
            'search' => $this->search,
            'statusFilter' => $this->statusFilter,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->dispatch('filter-updated', [
            'search' => $this->search,
            'statusFilter' => $this->statusFilter,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection
        ]);
    }

    public function render()
    {
        return view('livewire.quote.filters');
    }
}
