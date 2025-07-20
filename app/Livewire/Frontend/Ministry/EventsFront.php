<?php

namespace App\Livewire\Frontend\Ministry;

use App\Models\Ministry;
use App\Models\MinistryEvent;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EventsFront extends Component
{
    public $ministryId = null;
    public $timeFilter = 'upcoming';
    public $ministries = [];

    public function mount()
    {
        $this->ministries = Ministry::orderBy('name')->pluck('name', 'id');
    }

    public function getEventsProperty()
    {
        $query = MinistryEvent::query()
            ->with('ministry')
            ->orderBy('event_date', $this->timeFilter === 'past' ? 'desc' : 'asc');

        if ($this->ministryId) {
            $query->where('ministry_id', $this->ministryId);
        }

        if ($this->timeFilter === 'upcoming') {
            $query->where('event_date', '>=', Carbon::now());
        } elseif ($this->timeFilter === 'past') {
            $query->where('event_date', '<', Carbon::now());
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.frontend.ministry.events-front', [
            'events' => $this->events
        ]);
    }
}
