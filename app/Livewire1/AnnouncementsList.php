<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class AnnouncementsList extends Component
{
    public $showAll = false;
    public $limit = 2;

    public function loadMore()
    {
        $this->showAll = true;
    }

    public function render()
    {
        $announcements = Announcement::query()
            ->published()
            ->current()
            ->latest('announcement_date')
            ->when(!$this->showAll, fn($query) => $query->limit($this->limit))
            ->get();

        $hasMore = !$this->showAll && Announcement::published()->current()->count() > $this->limit;

        return view('livewire.announcements-list', [
            'announcements' => $announcements,
            'hasMore' => $hasMore
        ]);
    }
}
