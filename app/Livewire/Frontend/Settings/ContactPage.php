<?php

namespace App\Livewire\Frontend\Settings;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactPage extends Component
{
    /* ---------- Form fields ---------- */
    public $name = '';
    public $email = '';
    public $subject = 'General Inquiry';
    public $message = '';
    public $consent = false;

    /* ---------- UI feedback ---------- */
    public $success = '';

    /* ---------- Validation ---------- */
    protected function rules()
    {
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'consent' => 'accepted',
        ];
    }

    /* ---------- Submit ---------- */
    public function submit()
    {
        $this->validate();

        $record = ContactMessage::create([
            'name'       => $this->name,
            'email'      => $this->email,
            'subject'    => $this->subject,
            'message'    => $this->message,
            'status'     => 'unread',
            'priority'   => 'medium',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Optional admin notification
        Mail::to('info@netops.ink')
            ->send(new \App\Mail\NewContactMessage($record));

        $this->resetExcept('success');
        $this->success = 'Thank you for your message! We will get back to you soon.';
    }

    /* ---------- Render ---------- */
    public function render()
    {
        return view('livewire.frontend.settings.contact-page')
            ->layout('web.layouts.front-layout');
    }
}