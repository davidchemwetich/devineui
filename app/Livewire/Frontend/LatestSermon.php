<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class LatestSermon extends Component
{
    // Static sermon data for the component
    public $latestSermon = [
        'title' => 'Finding Peace in Christ',
        'subtitle' => 'Overcoming Anxiety Through Faith',
        'series' => 'Peace Series',
        'part' => 'Part 3',
        'scripture' => 'John 16:33',
        'date' => 'April 9, 2025',
        'thumbnail' => 'assets/images/citwam/download.jpeg',
        'pastor' => [
            'name' => 'Pastor Paul John',
            'image' => 'assets/images/citwam/IMG-20210513-WA0009.jpg',
        ],
        'youtube_id' => 'Eyog3BrJtfA?t=13', // YouTube video ID
        'mp3_file' => 'assets/media/sermons/finding-peace-in-christ.mp3',
        'notes_file' => 'assets/documents/sermon-notes/peace-in-christ-notes.pdf',
        'description' => 'In this transformative message, Pastor Johnson explores biblical principles for overcoming anxiety and finding true peace in Christ. Drawing from Philippians 4:6-7, discover practical steps to:',
        'key_points' => [
            'Cast your cares on God',
            'Practice thankful prayer',
            'Guard your heart and mind',
        ],
        'tags' => ['anxiety', 'peace', 'prayer', 'faith'],
        'series_id' => 12, // ID to link to full series
    ];

    // Toggle state for video modal
    public $showVideoModal = false;

    public function toggleVideoModal()
    {
        $this->showVideoModal = !$this->showVideoModal;
    }
    
    public function trackSermonView()
    {
        // Could be expanded to track sermon views in a production app
        session()->flash('message', 'Enjoying the sermon! God bless you.');
    }
    
    public function trackDownload($type)
    {
        // Could log downloads in a production app
        session()->flash('message', "Thank you for downloading the sermon $type!");
    }

    public function render()
    {
        return view('livewire.frontend.latest-sermon', [
            'sermon' => $this->latestSermon
        ]);
    }
}