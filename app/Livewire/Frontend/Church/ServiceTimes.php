<?php

namespace App\Livewire\Frontend\Church;

use Livewire\Component;

class ServiceTimes extends Component
{
    public $services = [
        [
            'day' => 'Sunday',
            'name' => 'Sunday Worship',
            'times' => ['9:00 AM', '11:00 AM'],
            'description' => 'Join us for praise, worship, and an inspiring message',
            'icon' => 'sun'
        ],
        [
            'day' => 'Wednesday',
            'name' => 'Midweek Service',
            'times' => ['7:00 PM'],
            'description' => 'A midweek spiritual recharge with prayer and Bible study',
            'icon' => 'book-open'
        ],
        [
            'day' => 'Friday',
            'name' => 'Youth Night',
            'times' => ['6:30 PM'],
            'description' => 'Special service for teens and young adults',
            'icon' => 'users'
        ],
        [
            'day' => 'Saturday',
            'name' => 'Prayer Meeting',
            'times' => ['8:00 AM'],
            'description' => 'Gather together for community prayer',
            'icon' => 'heart'
        ]
    ];

    public $currentService = 0;
    
    public function nextService()
    {
        if ($this->currentService < count($this->services) - 1) {
            $this->currentService++;
        } else {
            $this->currentService = 0;
        }
    }
    
    public function prevService()
    {
        if ($this->currentService > 0) {
            $this->currentService--;
        } else {
            $this->currentService = count($this->services) - 1;
        }
    }
    
    public function render()
    {
        return view('livewire.frontend.church.service-times');
    }
}