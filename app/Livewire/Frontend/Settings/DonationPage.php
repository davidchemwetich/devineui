<?php

namespace App\Livewire\Frontend\Settings;

use Livewire\Component;

class DonationPage extends Component
{
    public $activeTab = 'mpesa';
    public $donationTotal = 750430;
    public $mpesaPhone = '';
    public $mpesaAmount = '';
    public $showMpesaSuccess = false;
    public $showCryptoSuccess = false;

    protected $listeners = ['donationProcessed'];

    public function selectTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetValidation();
        $this->reset(['showMpesaSuccess', 'showCryptoSuccess']);
    }

    public function submitMpesa()
    {
        $this->validate([
            'mpesaPhone' => 'required|digits:10',
            'mpesaAmount' => 'required|numeric|min:100'
        ]);

        $this->emitSelf('donationProcessed');
    }

    public function donationProcessed()
    {
        $this->donationTotal += $this->mpesaAmount;
        $this->showMpesaSuccess = true;
        $this->reset(['mpesaPhone', 'mpesaAmount']);
    }

    public function copyToClipboard($text)
    {
        $this->dispatchBrowserEvent('copied', ['message' => 'Copied to clipboard!']);
    }

    public function render()
    {
        return view('livewire.frontend.settings.donation-page')->layout('web.layouts.front-layout');
    }
}
