<?php

namespace App\Livewire\Frontend\Chapel;

use App\Models\Church;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ChurchDetail extends Component
{
    public $church;
    public $contactForm = [
        'name' => '',
        'email' => '',
        'message' => ''
    ];

    protected $rules = [
        'contactForm.name' => 'required|min:2',
        'contactForm.email' => 'required|email',
        'contactForm.message' => 'required|min:10'
    ];

    public function mount($id)
    {
        $this->church = Church::with(['region', 'cluster', 'churchLeaders'])->findOrFail($id);
    }

    public function sendContactMessage()
    {
        $this->validate();

        // Here you could send email using Laravel's Mail functionality
        // Mail::to($this->church->email)->send(new ChurchContactMail($this->contactForm, $this->church));

        // Reset form fields
        $this->reset('contactForm');

        // Flash success message (will be handled by Alpine.js)
        $this->dispatch('contact-form-submitted');

        // Show success message with Alpine.js (see view)
        $this->js("document.querySelector('[x-data]').__x.$data.formSubmitted = true");
    }

    public function render()
    {
        return view('livewire.frontend.chapel.church-detail')
            ->layout('web.layouts.front-layout');
    }
}
