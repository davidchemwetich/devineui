<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;

class NavigationMenu extends Component
{
    public $institutionLogo;
    public $socialLinks = [];
    public $phone;
    public $email;
    
    // Navigation state
    public bool $isMobileMenuOpen = false;
    public bool $darkMode = false;

    // Scroll behavior state, managed by AlpineJS but can be mirrored here if needed.
    public bool $isScrolled = false;
    public bool $isNavVisible = true;

    public function mount()
    {
        // Cache site settings for 1 hour for better performance
        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::first();
        });

        if ($settings) {
            $this->institutionLogo = $settings->institution_logo;
            $this->socialLinks = $settings->social_links ?? [];
            $this->phone = $settings->phone;
            $this->email = $settings->email;
        }

        // Initialize dark mode from user's session, default to false
        $this->darkMode = session('darkMode', false);
    }

    /**
     * Toggles the mobile menu's visibility.
     */
    #[On('toggle-mobile-menu')]
    public function toggleMobileMenu()
    {
        $this->isMobileMenuOpen = !$this->isMobileMenuOpen;
        $this->dispatch('body-scroll-lock', lock: $this->isMobileMenuOpen);
    }

    /**
     * Closes the mobile menu.
     */
    #[On('close-mobile-menu')]
    public function closeMobileMenu()
    {
        if ($this->isMobileMenuOpen) {
            $this->isMobileMenuOpen = false;
            $this->dispatch('body-scroll-lock', lock: false);
        }
    }

    /**
     * Toggles dark mode and persists the setting in the session.
     */
    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;
        session(['darkMode' => $this->darkMode]);
        $this->dispatch('dark-mode-updated', darkMode: $this->darkMode);
    }

    /**
     * Listener for scroll events from AlpineJS to update component state.
     */
    #[On('nav-scrolled')]
    public function onNavScrolled(bool $scrolled, bool $visible)
    {
        $this->isScrolled = $scrolled;
        $this->isNavVisible = $visible;
    }

    /**
     * Defines the navigation structure.
     * Caching this data can further improve performance.
     */
    public function getNavigationItems(): array
    {
        return [
            'home' => ['label' => 'Home', 'route' => 'home', 'icon' => 'fas fa-home'],
            'about' => [
                'label' => 'About Us',
                'icon' => 'fas fa-users',
                'children' => [
                    ['label' => 'Who We Are', 'route' => 'about', 'icon' => 'fas fa-heart'],
                    ['label' => 'Regional Presence', 'route' => 'ministry.churches', 'icon' => 'fas fa-map-marker-alt'],
                    ['label' => 'Leadership', 'route' => 'church.leadership', 'icon' => 'fas fa-crown'],
                ]
            ],
            'ministries' => [
                'label' => 'Ministries',
                'icon' => 'fas fa-hands-praying',
                'children' => [
                    ['label' => 'Explore Ministries', 'route' => 'ministries.index', 'icon' => 'fas fa-compass'],
                    ['label' => 'Youth Ministry', 'route' => 'ministries.index', 'params' => ['category' => 'youth'], 'icon' => 'fas fa-child'],
                    ['label' => 'Women\'s Ministry', 'route' => 'ministries.index', 'params' => ['category' => 'women'], 'icon' => 'fas fa-female'],
                ]
            ],
            'sermons' => ['label' => 'Sermons', 'route' => 'sermons', 'icon' => 'fas fa-bible'],
            'gallery' => ['label' => 'Gallery', 'route' => 'ministry.galleries', 'icon' => 'fas fa-images'],
            'events' => ['label' => 'Events', 'route' => 'frontend.ministry.events', 'icon' => 'fas fa-calendar-alt'],
            'contact' => ['label' => 'Contact Us', 'route' => 'contact', 'icon' => 'fas fa-envelope'],
        ];
    }

    public function render()
    {
        return view('livewire.frontend.navigation-menu', [
            'navigationItems' => $this->getNavigationItems()
        ]);
    }
}
