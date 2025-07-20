<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactForm extends Component
{
    public $fullname = '';
    public $email = '';
    public $phone = '';
    public $communicationType = '';
    public $subject = '';
    public $message = '';

    // Communication type options
    public $communicationTypes = [
        'email' => 'Email',
        'phone' => 'Phone',
        'both' => 'Both'
    ];

    // Form validation rules
    protected $rules = [
        'fullname' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'communicationType' => 'required',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    protected $messages = [
        'fullname.required' => 'Please enter your full name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'phone.required' => 'Please enter your phone number.',
        'phone.regex' => 'Please enter a valid phone number.',
        'communicationType.required' => 'Please select how you prefer to be contacted.',
        'subject.required' => 'Please enter a subject for your message.',
        'message.required' => 'Please enter your message.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
        
        try {
            Mail::to('greyhat@null.net')->send(new ContactFormMail($validatedData));
            
            $this->reset(['fullname', 'email', 'phone', 'communicationType', 'subject', 'message']);
            
            session()->flash('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Exception $e) {
            session()->flash('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}