<?php

namespace App\Livewire\Shield\Ministry;

use Livewire\Component;
use App\Models\MinistryEvent;
use App\Models\Ministry;
use Livewire\WithPagination;

class MinistryEventList extends Component
{
    use WithPagination;
    
    public $search = '';
    public $ministry_filter = '';
    public $date_filter = '';
    public $sortField = 'event_date';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'ministry_filter' => ['except' => ''],
        'date_filter' => ['except' => ''],
        'sortField' => ['except' => 'event_date'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10],
    ];
    
    /**
     * Reset pagination when filters change
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingMinistryFilter()
    {
        $this->resetPage();
    }
    
    public function updatingDateFilter()
    {
        $this->resetPage();
    }
    
    /**
     * Sort results by the given field
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    /**
     * Delete the given event
     */
    public function deleteEvent($eventId)
    {
        $event = MinistryEvent::find($eventId);
        if ($event) {
            $event->delete();
            session()->flash('message', 'Event deleted successfully.');
        }
    }
    
    /**
     * Render the component
     */
    public function render()
    {
        $ministries = Ministry::orderBy('name')->get();
        
        $events = MinistryEvent::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->ministry_filter, function ($query) {
                return $query->where('ministry_id', $this->ministry_filter);
            })
            ->when($this->date_filter, function ($query) {
                if ($this->date_filter === 'upcoming') {
                    return $query->where('event_date', '>=', now());
                } elseif ($this->date_filter === 'past') {
                    return $query->where('event_date', '<', now());
                }
                return $query;
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->with('ministry')
            ->paginate($this->perPage);
            
        return view('livewire.shield.ministry.ministry-event-list', [
            'events' => $events,
            'ministries' => $ministries,
        ])->layout('shield.layouts.shield');
    }
}