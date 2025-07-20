<?php

namespace App\Http\Controllers;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('emails.contact');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // Add IP and user agent information
        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();
        
        // Set initial status and priority
        $validated['status'] = 'unread';
        $validated['priority'] = 'medium';
        
        // Create the contact message
        $contactMessage = ContactMessage::create($validated);
        
        // Optional: Send email notification to admins about new message
        Mail::to('info@netops.ink')->send(new \App\Mail\NewContactMessage($contactMessage));
        
        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}