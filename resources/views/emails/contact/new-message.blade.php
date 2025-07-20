<x-mail::message>
# New Contact Form Submission

You have received a new message from your website's contact form.

**From:** {{ $contactMessage->name }} ({{ $contactMessage->email }})  
**Subject:** {{ $contactMessage->subject }}  
**Date:** {{ $contactMessage->created_at->format('F j, Y, g:i a') }}

<x-mail::panel>
{{ $contactMessage->message }}
</x-mail::panel>

<x-mail::button :url="route(config('app.admin_prefix') . '.contact.messages')">
View in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>