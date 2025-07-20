<?php

namespace App\Livewire\Shield\Settings;

use Livewire\WithFileUploads;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Livewire\Component;

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
        'about' => 'required|min:10',
        'address' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'socialLinks.facebook' => 'nullable|url',
        'socialLinks.twitter' => 'nullable|url',
        'socialLinks.instagram' => 'nullable|url',
        'socialLinks.linkedin' => 'nullable|url',
        'newLogo' => 'nullable|image|max:1024',
        'newFavicon' => 'nullable'
        // |image|max:1024|dimensions:width=32,height=32
    ];

    public function mount()
    {
        $this->settings = SiteSetting::first() ?? new SiteSetting();
        $this->about = $this->settings->about;
        $this->address = $this->settings->address;
        $this->phone = $this->settings->phone;
        $this->email = $this->settings->email;
        $this->socialLinks = $this->settings->social_links ?? $this->socialLinks;
    }

    public function updatedNewLogo()
    {
        $this->validate([
            'newLogo' => 'image|max:1024'
        ]);
        $this->cleanupOldPreview();
    }

    public function updatedNewFavicon()
    {
        $this->validate([
            'newFavicon' => 'image|max:1024'
        ]);
        $this->cleanupOldPreview();
    }

    public function save()
    {
        $this->validate();

        try {
            // Handle Logo Upload
            if ($this->newLogo) {
                // Delete old logo if exists
                if ($this->settings->institution_logo) {
                    Storage::disk('public')->delete($this->settings->institution_logo);
                }

                // Store new logo
                $logoPath = $this->newLogo->storeAs(
                    'settings/logos',
                    'institution_logo_' . time() . '.' . $this->newLogo->getClientOriginalExtension(),
                    'public'
                );

                // Update settings with new logo path
                $this->settings->institution_logo = $logoPath;
            }

            // Handle Favicon Upload
            if ($this->newFavicon) {
                // Delete old favicon if exists
                if ($this->settings->favicon) {
                    Storage::disk('public')->delete($this->settings->favicon);
                }

                // Store new favicon
                $faviconPath = $this->newFavicon->storeAs(
                    'settings/favicons',
                    'favicon_' . time() . '.' . $this->newFavicon->getClientOriginalExtension(),
                    'public'
                );

                // Update settings with new favicon path
                $this->settings->favicon = $faviconPath;
            }

            // Save all settings
            $this->settings->about = $this->about;
            $this->settings->address = $this->address;
            $this->settings->phone = $this->phone;
            $this->settings->email = $this->email;
            $this->settings->social_links = $this->socialLinks;

            $this->settings->save();

            // Reset file inputs
            $this->newLogo = null;
            $this->newFavicon = null;

            $this->dispatch('settings-saved');

            // notify()->success('Settings saved successfully ⚡️');
            session()->flash('message', 'Settings saved successfully.');
        } catch (\Exception $e) {
            Log::error('Settings save error: ' . $e->getMessage());
            session()->flash('error', 'Error saving settings: ' . $e->getMessage());
            // drakify('Error saving settings: ' . $e->getMessage());


        }
    }


    public function render()
    {
        return view('livewire.shield.settings.general-settings');
    }

    public function removeExistingLogo()
    {
        if ($this->settings->institution_logo) {
            Storage::disk('public')->delete($this->settings->institution_logo);
            $this->settings->institution_logo = null;
            $this->settings->save();
            session()->flash('message', 'Logo removed successfully.');
        }
    }

    public function removeExistingFavicon()
    {
        if ($this->settings->favicon) {
            Storage::disk('public')->delete($this->settings->favicon);
            $this->settings->favicon = null;
            $this->settings->save();
            session()->flash('message', 'Favicon removed successfully.');
        }
    }

    protected function cleanupOldPreview()
    {
        // Clean up old temporary upload if exists
        if (property_exists($this, 'oldTemporaryLogo')) {
            Storage::disk('livewire-tmp')->delete($this->oldTemporaryLogo);
        }
    }
}
