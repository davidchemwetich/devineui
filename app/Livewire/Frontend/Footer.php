<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\SiteSetting;

/**
 * Footer Component
 *
 * This component renders the website footer.
 * It fetches site settings and social links from the database.
 * The view is heavily styled with Tailwind CSS and uses Alpine.js for interactivity.
 */
class Footer extends Component
{
    /**
     * The site settings model instance.
     * Contains information like logo, about text, etc.
     * @var \App\Models\SiteSetting|null
     */
    public $settings;

    /**
     * An array of social media links.
     * e.g., ['facebook' => 'https://...', 'twitter' => 'https://...']
     * @var array
     */
    public $socialLinks = [];

    /**
     * Mount the component.
     *
     * Fetches the first record from the site_settings table to populate
     * the footer with dynamic data.
     *
     * @return void
     */
    public function mount()
    {
        // Fetch the first available site settings record.
        // Using first() is efficient for a settings table that should only have one row.
        $this->settings = SiteSetting::first();

        // If settings are found, extract the social links.
        // The null coalescing operator provides a fallback to an empty array.
        if ($this->settings) {
            $this->socialLinks = $this->settings->social_links ?? [];
        }
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.frontend.footer');
    }
}