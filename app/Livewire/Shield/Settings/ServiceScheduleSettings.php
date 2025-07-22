<?php

namespace App\Livewire\Shield\Settings;

use Livewire\Component;
use App\Models\ServiceDay;
use App\Models\ServiceTime;

class ServiceScheduleSettings extends Component
{
    public $serviceDays = [];
    public $selectedDayId = null;
    public $showModal = false;
    public $editingTimeId = null;

    // Form properties
    public $timeForm = [
        'time' => '',
        'name' => '',
        'language' => 'English',
    ];

    public $dayForm = [
        'day' => '',
    ];

    public $showDayModal = false;
    public $editingDayId = null;

    protected $rules = [
        'timeForm.time' => 'required|string|max:50',
        'timeForm.name' => 'required|string|max:100',
        'timeForm.language' => 'required|string|max:50',
        'dayForm.day' => 'required|string|max:20|unique:service_days,day',
    ];

    protected $messages = [
        'timeForm.time.required' => 'Service time is required.',
        'timeForm.name.required' => 'Service name is required.',
        'timeForm.language.required' => 'Language is required.',
        'dayForm.day.required' => 'Day name is required.',
        'dayForm.day.unique' => 'This day already exists.',
    ];

    public function mount()
    {
        $this->loadServiceDays();
    }

    public function loadServiceDays()
    {
        $this->serviceDays = ServiceDay::with(['times' => function ($query) {
            $query->orderBy('time');
        }])->orderByRaw("FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')")->get();
    }

    public function openTimeModal($dayId, $timeId = null)
    {
        $this->selectedDayId = $dayId;
        $this->editingTimeId = $timeId;

        if ($timeId) {
            $serviceTime = ServiceTime::find($timeId);
            $this->timeForm = [
                'time' => $serviceTime->time,
                'name' => $serviceTime->name,
                'language' => $serviceTime->language,
            ];
        } else {
            $this->reset(['timeForm']);
            $this->timeForm['language'] = 'English';
        }

        $this->showModal = true;
    }

    public function saveTime()
    {
        $this->validate([
            'timeForm.time' => 'required|string|max:50',
            'timeForm.name' => 'required|string|max:100',
            'timeForm.language' => 'required|string|max:50',
        ]);

        if ($this->editingTimeId) {
            $serviceTime = ServiceTime::find($this->editingTimeId);
            $serviceTime->update($this->timeForm);
            session()->flash('success', 'Service time updated successfully.');
        } else {
            ServiceTime::create([
                'service_day_id' => $this->selectedDayId,
                ...$this->timeForm
            ]);
            session()->flash('success', 'Service time added successfully.');
        }

        $this->closeTimeModal();
        $this->loadServiceDays();
    }

    public function deleteTime($timeId)
    {
        ServiceTime::find($timeId)->delete();
        session()->flash('success', 'Service time deleted successfully.');
        $this->loadServiceDays();
    }

    public function closeTimeModal()
    {
        $this->showModal = false;
        $this->reset(['timeForm', 'selectedDayId', 'editingTimeId']);
        $this->timeForm['language'] = 'English';
    }

    public function openDayModal($dayId = null)
    {
        $this->editingDayId = $dayId;

        if ($dayId) {
            $serviceDay = ServiceDay::find($dayId);
            $this->dayForm = [
                'day' => $serviceDay->day,
            ];
        } else {
            $this->reset(['dayForm']);
        }

        $this->showDayModal = true;
    }

    public function saveDay()
    {
        $rules = ['dayForm.day' => 'required|string|max:20'];

        if ($this->editingDayId) {
            $rules['dayForm.day'] .= '|unique:service_days,day,' . $this->editingDayId;
        } else {
            $rules['dayForm.day'] .= '|unique:service_days,day';
        }

        $this->validate($rules);

        if ($this->editingDayId) {
            $serviceDay = ServiceDay::find($this->editingDayId);
            $serviceDay->update($this->dayForm);
            session()->flash('success', 'Service day updated successfully.');
        } else {
            ServiceDay::create($this->dayForm);
            session()->flash('success', 'Service day added successfully.');
        }

        $this->closeDayModal();
        $this->loadServiceDays();
    }

    public function deleteDay($dayId)
    {
        $serviceDay = ServiceDay::with('times')->find($dayId);

        if ($serviceDay->times->count() > 0) {
            session()->flash('error', 'Cannot delete a day that has service times. Please remove all service times first.');
            return;
        }

        $serviceDay->delete();
        session()->flash('success', 'Service day deleted successfully.');
        $this->loadServiceDays();
    }

    public function closeDayModal()
    {
        $this->showDayModal = false;
        $this->reset(['dayForm', 'editingDayId']);
    }

    public function render()
    {
        return view('livewire.shield.settings.service-schedule-settings')->layout('shield.layouts.shield');
    }
}