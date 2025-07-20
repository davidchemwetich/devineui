<?php

namespace App\Livewire\Frontend\Ministry;

use Livewire\Component;
use App\Models\Ministry;
use App\Models\MinistryEvent;
use Livewire\WithPagination;
use Carbon\Carbon;


class EventsDisplay extends Component
{
    use WithPagination;
    
    public $ministryId = null;
    public $searchTerm = '';
    public $timeFilter = 'upcoming';
    public $perPage = 6;
    public $ministries = [];
    
    protected $queryString = [
        'ministryId' => ['except' => null],
        'searchTerm' => ['except' => ''],
        'timeFilter' => ['except' => 'upcoming'],
    ];
    
    public function mount()
    {
        $this->ministries = Ministry::orderBy('name')->get();
    }
    
    public function resetFilters()
    {
        $this->reset(['ministryId', 'searchTerm', 'timeFilter']);
        $this->resetPage();
    }
    
    public function updatedMinistryId()
    {
        $this->resetPage();
    }
    
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
    
    public function updatedTimeFilter()
    {
        $this->resetPage();
    }
    
    public function getEventsProperty()
    {
        $query = MinistryEvent::query()
            ->with('ministry')
            ->orderBy('event_date', $this->timeFilter === 'past' ? 'desc' : 'asc');
        
        if ($this->ministryId) {
            $query->where('ministry_id', $this->ministryId);
        }
        
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('location', 'like', '%' . $this->searchTerm . '%');
            });
        }
        
        // Apply time filtering
        if ($this->timeFilter === 'upcoming') {
            $query->where('event_date', '>=', Carbon::now());
        } elseif ($this->timeFilter === 'past') {
            $query->where('event_date', '<', Carbon::now());
        }
        // 'all' doesn't need a filter
        
        return $query->paginate($this->perPage);
    }
    
    public function render()
    {
        return view('livewire.frontend.ministry.events-display', [
            'events' => $this->events
        ])->layout('front.layouts.front-layout');
    }
}