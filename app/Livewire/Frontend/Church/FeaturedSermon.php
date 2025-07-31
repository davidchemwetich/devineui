<?php

namespace App\Livewire\Frontend\Church;

use App\Models\Sermon;
use Livewire\Component;

class FeaturedSermon extends Component
{
    public ?Sermon $featuredSermon;

    public function mount()
    {
        // Eager load the 'user' relationship to prevent N+1 query issues in the view.
        $this->featuredSermon = Sermon::query()
            ->where('is_featured', true)
            ->where('status', 'published')
            ->with('user')
            ->latest('preached_on')
            ->first();
    }

    /**
     * Get social share links for the featured sermon.
     */
    public function getShareLinksProperty(): array
    {
        if (!$this->featuredSermon) {
            return [];
        }

        $url = url()->current();
        $title = rawurlencode($this->featuredSermon->title);

        return [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'twitter' => "https://twitter.com/intent/tweet?url={$url}&text={$title}",
            'whatsapp' => "https://api.whatsapp.com/send?text={$title}%20{$url}",
        ];
    }

    public function render()
    {
        return view('livewire.frontend.church.featured-sermon');
    }
}