<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class ServiceTimes extends Component
{
    public $services = [
        [
            'day' => 'Sunday',
            'times' => [
                ['time' => '8:00 AM - 10:00 AM', 'name' => 'Early Morning Service', 'language' => 'English'],
                ['time' => '10:30 AM - 12:30 PM', 'name' => 'Main Service', 'language' => 'English & Swahili'],
                ['time' => '2:00 PM - 4:00 PM', 'name' => 'Youth Service', 'language' => 'English']
            ]
        ],
        [
            'day' => 'Wednesday',
            'times' => [
                ['time' => '5:30 PM - 7:00 PM', 'name' => 'Midweek Prayer Service', 'language' => 'Swahili']
            ]
        ],
        [
            'day' => 'Friday',
            'times' => [
                ['time' => '6:00 PM - 8:00 PM', 'name' => 'Worship Night', 'language' => 'English & Swahili']
            ]
        ],
        [
            'day' => 'Saturday',
            'times' => [
                ['time' => '10:00 AM - 12:00 PM', 'name' => 'Bible Study', 'language' => 'English'],
                ['time' => '3:00 PM - 5:00 PM', 'name' => 'Community Outreach', 'language' => 'Swahili']
            ]
        ]
    ];

    public function render()
    {
        return view('livewire.frontend.service-times');
    }
}