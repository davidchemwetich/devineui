<?php

namespace App\Livewire\Frontend\Settings;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        $churchName = "Christ the Way Ministries Church";
        $contactEmail = "privacy@christtheway.org";
        $effectiveDate = "January 1, 2023";

        return view('livewire.frontend.settings.privacy-policy', [
            'churchName' => $churchName,
            'contactEmail' => $contactEmail,
            'effectiveDate' => $effectiveDate
        ])->layout('front.layouts.front-layout');
    }
}