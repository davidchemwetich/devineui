@if($member->email)
<a href="mailto:{{ $member->email }}" class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100"
    title="{{ $member->email }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 8l7.9 5.3a2 2 0 002.2 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
    </svg>
</a>
@endif

@if($member->phone)
<a href="tel:{{ $member->phone }}" class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100"
    title="{{ $member->phone }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
    </svg>
</a>
@endif

@if($member->whatsapp)
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}" target="_blank" rel="noopener noreferrer"
    class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-green-100" title="WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 sm:w-4 sm:h-4" fill="currentColor"
        viewBox="0 0 24 24">
        <path
            d="M20.52 3.48A11.93 11.93 0 0012 0C5.37 0 0 5.37 0 12a11.9 11.9 0 001.74 6.27L0 24l6.27-1.74A11.9 11.9 0 0012 24c6.63 0 12-5.37 12-12a11.93 11.93 0 00-3.48-8.52zM12 22c-1.97 0-3.83-.48-5.47-1.34l-.39-.22L5 21l1.27-3.73-.19-.38A9.97 9.97 0 012 12c0-5.51 4.49-10 10-10s10 4.49 10 10-4.49 10-10 10zm5.8-7.6c-.3-.15-1.76-.87-2.03-.96-.27-.1-.47-.15-.67.15s-.77.96-.94 1.16c-.17.2-.34.2-.63.07-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.75-1.64-2.05-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52s-.67-1.62-.92-2.22c-.24-.6-.48-.52-.67-.53-.17-.01-.37-.01-.57-.01s-.5.07-.77.37c-.27.3-1.03 1.01-1.03 2.47 0 1.46 1.06 2.86 1.21 3.06.15.2 2.1 3.21 5.09 4.49.71.31 1.27.49 1.7.63.71.22 1.36.19 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.08-.13-.3-.2-.6-.35z" />
    </svg>
</a>
@endif

@if($member->facebook_url)
<a href="{{ $member->facebook_url }}" target="_blank" rel="noopener noreferrer"
    class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100" title="Facebook">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800 sm:w-4 sm:h-4" fill="currentColor"
        viewBox="0 0 24 24">
        <path
            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.9V12h2.538V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
    </svg>
</a>
@endif
