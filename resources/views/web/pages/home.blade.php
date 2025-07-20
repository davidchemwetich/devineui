<x-front-layout>

    {{-- Hero Section: Displays the main introductory content for the church. --}}
    <livewire:frontend.church-hero />
    {{-- Service Times Section: Displays the schedule of church services. --}}
    @livewire('frontend.service-times')

    {{-- About Us Section: Provides information about the church's mission, vision, and history. --}}
    <livewire:frontend.about-home />
    {{-- Church Near Section: Displays nearby churches or locations. --}}
    <livewire:frontend.church-near />

    @livewire('frontend.church.featured-sermon')

    {{-- Latest Sermon Section: Highlights the most recent sermon or message. --}}
    @livewire('frontend.church.team-front')

    {{-- Upcoming Events Section: Lists upcoming church events and activities. --}}
    @livewire('frontend.ministry.events-front')

</x-front-layout>
