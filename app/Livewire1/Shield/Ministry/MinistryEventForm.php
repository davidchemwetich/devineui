<?php

namespace App\Livewire\Shield\Ministry;

use App\Models\Ministry;
use App\Models\MinistryEvent;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class MinistryEventForm extends Component
{
    use WithFileUploads;

    public $ministries;
    public MinistryEvent $ministryEvent;
    public $lat;
    public $lng;
    public $ministry_id;
    public $title;
    public $description;
    public $event_date;
    public $location;
    public $location_url;

    protected $messages = [
        'title.required' => 'Please provide an event title',
        'ministry_id.required' => 'Please select a ministry',
        'event_date.required' => 'Event date is required',
        'lat.numeric' => 'Latitude must be a valid number',
        'lng.numeric' => 'Longitude must be a valid number',
    ];

    // Updated rules to use direct properties instead of nested properties
    protected $rules = [
        'title' => 'required|string|max:255',
        'ministry_id' => 'required|exists:ministries,id',
        'description' => 'nullable|string',
        'event_date' => 'required|date',
        'location' => 'nullable|string|max:255',
        'location_url' => 'nullable|url|max:255',
        'lat' => 'nullable|numeric',
        'lng' => 'nullable|numeric',
    ];

    public function mount($id = null)
    {
        $this->ministries = Ministry::orderBy('name')->get();
        
        try {
            if ($id) {
                $this->ministryEvent = MinistryEvent::where('id', $id)->firstOrFail();
                
                // Set individual properties from the model
                $this->ministry_id = $this->ministryEvent->ministry_id;
                $this->title = $this->ministryEvent->title;
                $this->description = $this->ministryEvent->description;
                $this->event_date = $this->ministryEvent->event_date;
                $this->location = $this->ministryEvent->location;
                $this->location_url = $this->ministryEvent->location_url;
                
                if ($this->ministryEvent->coordinates) {
                    $this->lat = $this->ministryEvent->coordinates['lat'] ?? null;
                    $this->lng = $this->ministryEvent->coordinates['lng'] ?? null;
                }
            } else {
                $this->ministryEvent = new MinistryEvent();
                // Initialize event date to tomorrow
                $this->event_date = now()->addDay()->format('Y-m-d\TH:i');
            }
        } catch (\Exception $e) {
            Log::error('Failed to load ministry event: ' . $e->getMessage());
            session()->flash('error', 'Failed to load the event data: ' . $e->getMessage());
            return redirect()->route(config('app.admin_prefix') . '.ministry.events.index');
        }
    }

    public function save()
    {
        $validatedData = $this->validate();
        
        try {
            // Set properties from validated data to model
            $this->ministryEvent->ministry_id = $this->ministry_id;
            $this->ministryEvent->title = $this->title;
            $this->ministryEvent->description = $this->description;
            $this->ministryEvent->event_date = $this->event_date;
            $this->ministryEvent->location = $this->location;
            $this->ministryEvent->location_url = $this->location_url;
            
            // Set coordinates
            if ($this->lat && $this->lng ) {
                $this->ministryEvent->coordinates = [
                    'lat' => (float)$this->lat, 
                    'lng' => (float)$this->lng
                ];
            } else {
                $this->ministryEvent->coordinates = null;
            }

            $this->ministryEvent->save();

            session()->flash('success', 'Event saved successfully!');
            return redirect()->route('admin.ministry.events.index');
        } catch (\Exception $e) {
            Log::error('Failed to save ministry event: ' . $e->getMessage());
            session()->flash('error', 'Failed to save the event. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.shield.ministry.ministry-event-form')
            ->layout('shield.layouts.shield-layout');
    }
}