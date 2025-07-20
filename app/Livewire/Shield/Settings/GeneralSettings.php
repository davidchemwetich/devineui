<?php

namespace App\Livewire\Shield\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GeneralSettings extends Component
{
    use WithFileUploads;

    public $settings;
    public $newLogo;
    public $newFavicon;
    public $about;
    public $address;
    public $phone;
    public $email;
    public $socialLinks = [
        'facebook' => '',
        'twitter' => '',
        'instagram' => '',
        'linkedin' => ''
    ];

    protected $rules = [
        'about' => 'nullable|string|min:10',
        'address' => 'nullable|string',
        'phone' => 'nullable|string',
        'email' => 'nullable|email',
        'socialLinks.facebook' => 'nullable|url',
        'socialLinks.twitter' => 'nullable|url',
        'socialLinks.instagram' => 'nullable|url',
        'socialLinks.linkedin' => 'nullable|url',
        'newLogo' => 'nullable|image|max:2048', // Increased max size
        'newFavicon' => 'nullable|image|max:1024|dimensions:width=32,height=32'
    ];

    /**
     * Mount the component and initialize the properties.
     */
    public function mount()
    {
        $this->settings = SiteSetting::firstOrNew([]);
        $this->about = $this->settings->about;
        $this->address = $this->settings->address;
        $this->phone = $this->settings->phone;
        $this->email = $this->settings->email;
        $this->socialLinks = array_merge($this->socialLinks, $this->settings->social_links ?? []);
    }

    /**
     * Save the settings to the database.
     */
    public function save()
    {
        $this->validate();

        try {
            if ($this->newLogo) {
                if ($this->settings->institution_logo) {
                    Storage::disk('public')->delete($this->settings->institution_logo);
                }
                $this->settings->institution_logo = $this->newLogo->store('settings/logos', 'public');
            }

            if ($this->newFavicon) {
                if ($this->settings->favicon) {
                    Storage::disk('public')->delete($this->settings->favicon);
                }
                $this->settings->favicon = $this->newFavicon->store('settings/favicons', 'public');
            }

            $this->settings->about = $this->about;
            $this->settings->address = $this->address;
            $this->settings->phone = $this->phone;
            $this->settings->email = $this->email;
            $this->settings->social_links = $this->socialLinks;

            $this->settings->save();

            $this->newLogo = null;
            $this->newFavicon = null;
            
            $this->dispatch('notify', message: 'Settings saved successfully!', type: 'success');

        } catch (\Exception $e) {
            Log::error('Settings save error: ' . $e->getMessage());
            $this->dispatch('notify', message: 'Error saving settings: ' . $e->getMessage(), type: 'error');
        }
    }

    /**
     * Remove the existing logo.
     */
    public function removeExistingLogo()
    {
        if ($this->settings->institution_logo) {
            Storage::disk('public')->delete($this->settings->institution_logo);
            $this->settings->institution_logo = null;
            $this->settings->save();
            $this->dispatch('notify', message: 'Logo removed successfully.', type: 'success');
        }
    }

    /**
     * Remove the existing favicon.
     */
    public function removeExistingFavicon()
    {
        if ($this->settings->favicon) {
            Storage::disk('public')->delete($this->settings->favicon);
            $this->settings->favicon = null;
            $this->settings->save();
            $this->dispatch('notify', message: 'Favicon removed successfully.', type: 'success');
        }
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.shield.settings.general-settings')->layout('shield.layouts.shield');
    }
}
