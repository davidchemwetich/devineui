@push('styles')
<style>
    .animated-gradient-text {
        background: linear-gradient(45deg, #006400, #008000, #15803d);
        background-size: 300% 300%;
        animation: gradient-pulse 8s ease infinite;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    @keyframes gradient-pulse {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .bg-stained-glass {
        background: linear-gradient(45deg, rgba(0, 100, 0, 0.9), rgba(0, 128, 0, 0.8)),
            url('https://images.unsplash.com/photo-1507835661088-ac9e29c8b3fd?auto=format&fit=crop&w=1920&q=80');
        background-blend-mode: multiply;
        background-size: cover;
    }

    .dark .bg-stained-glass {
        background: linear-gradient(45deg, rgba(0, 80, 0, 0.9), rgba(21, 128, 61, 0.8)),
            url('https://images.unsplash.com/photo-1507835661088-ac9e29c8b3fd?auto=format&fit=crop&w=1920&q=80');
    }

    /* New styles for enhanced design */
    .team-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .team-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 128, 0, 0.2), rgba(21, 128, 61, 0.1));
        transform: translateY(-100%);
        transition: transform 0.5s ease;
        z-index: 0;
    }

    .team-card:hover::before {
        transform: translateY(0);
    }

    .team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .team-image {
        transition: all 0.5s ease;
    }

    .team-card:hover .team-image {
        transform: scale(1.05);
    }

    .swiper-pagination-bullet-active {
        background: #008000 !important;
    }

    .animated-fade-in {
        opacity: 0;
        animation: fadeIn 1s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .scroll-reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease;
    }

    .scroll-reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    .scripture-quote {
        font-family: 'Georgia', serif;
        position: relative;
        padding: 1.5rem;
        margin: 2rem 0;
        border-left: 4px solid #15803d;
        background-color: rgba(21, 128, 61, 0.05);
        border-radius: 0.5rem;
    }

    .scripture-quote::before {
        content: '"';
        position: absolute;
        top: -1.5rem;
        left: 0.5rem;
        font-size: 4rem;
        color: rgba(21, 128, 61, 0.2);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize Swiper
        const teamSwiper = new Swiper('.team-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });

        // Scroll reveal animation
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endpush

<div class="min-h-screen transition-colors duration-300 bg-gray-50 dark:bg-gray-900"
    x-data="{ activeCard: 0, teamMembers: {{ json_encode($aboutUs->team_members ?? []) }} }">
    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    {{ $aboutUs->heading ?? 'Welcome to Our Church Family' }}
                </h1>
                <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                    {{ $aboutUs->subheading ?? 'Walking in Faith, Growing in Grace' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <section class="py-16 dark:bg-gray-800">
        {{-- <div class="container relative z-10 px-4 mx-auto text-center"
            x-intersect="$el.classList.add('animate-fade-in-down')"> --}}
            {{-- <h1 class="mb-6 text-4xl font-bold text-[#008000] md:text-5xl lg:text-6xl animated-gradient-text">
                {{ $aboutUs->heading ?? 'Welcome to Our Church Family' }}
            </h1>
            <p class="text-xl font-medium text-[#008000] md:text-2xl opacity-90">
                {{ $aboutUs->subheading ?? 'Walking in Faith, Growing in Grace' }}
            </p> --}}
            {{--
        </div> --}}
        <div class="container px-4 mx-auto">
            <div class="grid items-center gap-12 md:grid-cols-2">
                <!-- Content -->
                <div class="prose max-w-none dark:prose-invert scroll-reveal" x-data="{ showImage: false }">
                    <span
                        class="inline-block px-4 py-1 mb-4 text-sm font-medium rounded-full text-white bg-[#008000]">About
                        Our Church</span>
                    <h2 class="mb-6 text-3xl font-bold text-gray-800 md:text-4xl dark:text-white">Serving Our Community
                        <span class="text-[#008000]">Since 2000</span>
                    </h2>
                    <div class="mb-8 text-black dark:text-[#15803d]">
                        {!! $aboutUs->content ?? '<p class="text-gray-600 dark:text-gray-300">Our church story begins
                            with faith and community. For over four decades, we have been a beacon of hope and spiritual
                            growth in our community. Through prayer, worship, and service, we strive to create a
                            welcoming space where all can experience God\'s love and grace.</p>' !!}
                    </div>

                    <div class="scripture-quote">
                        <p class="italic text-gray-700 dark:text-gray-300">"Jesus answered, ‘I am the way and the truth
                            and the life. No one comes to the Father except through me."</p>
                        <p class="text-right text-sm font-medium text-[#008000]"> — John 14:6 </p>
                    </div>
                </div>

                <!-- Image with Video Trigger -->
                <div class="relative group scroll-reveal" x-data="{ showVideo: false }" style="transition-delay: 0.3s">
                    @if($aboutUs->image_path)
                    <div class="relative overflow-hidden rounded-lg shadow-xl">
                        <img src="{{ $aboutUs->image_url }}" alt="About Our Church"
                            class="object-cover w-full transition-all duration-500 transform h-96 hover:scale-105">

                        <!-- Video Trigger Button -->
                        <button @click="showVideo = true"
                            class="absolute inset-0 w-full h-full flex items-center justify-center bg-[#008000]/30 hover:bg-[#15803d]/40 transition-colors">
                            <svg class="w-20 h-20 text-white transition-transform hover:scale-110" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                    @endif

                    <!-- Video Modal -->
                    <div x-show="showVideo" x-transition.opacity
                        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80"
                        @click.away="showVideo = false">
                        <div class="relative w-full max-w-4xl bg-[#008000] p-2 rounded-lg">
                            <button @click="showVideo = false"
                                class="absolute -top-8 right-0 text-white hover:text-[#15803d] transition-colors">
                                ✕ Close
                            </button>
                            @if($aboutUs->youtube_id)
                            <iframe src="https://www.youtube.com/embed/{{ $aboutUs->youtube_id }}"
                                class="w-full rounded-lg aspect-video" frameborder="0" allowfullscreen>
                            </iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section id="mission" class="py-16 bg-[#008000]/10 dark:bg-gray-800">
        <div class="container px-4 mx-auto">
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold animated-gradient-text">Our Mission & Vision</h2>
                <p class="max-w-2xl mx-auto mt-4 text-gray-600 dark:text-gray-300">Guided by faith and community
                    service, we strive to make a lasting impact in our world.</p>
            </div>

            <div class="grid gap-8 px-4 mx-auto md:grid-cols-2">
                <!-- Mission Card -->
                <div
                    class="p-8 bg-white dark:bg-gray-700 rounded-2xl shadow-lg border border-[#008000]/20 transition-transform hover:scale-102 scroll-reveal">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-[#008000]/10 rounded-full mr-4">
                            <span class="text-2xl">⛪</span>
                        </div>
                        <h2 class="text-3xl font-bold text-[#008000] dark:text-[#15803d]">
                            Our Mission
                        </h2>
                    </div>
                    <ul class="space-y-4 text-black dark:text-gray-300">
                        @foreach($aboutUs->missionPoints() as $point)
                        <li class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 w-6 h-6 text-[#008000]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ $point }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Vision Card -->
                <div class="p-8 bg-white dark:bg-gray-700 rounded-2xl shadow-lg border border-[#008000]/20 transition-transform hover:scale-102 scroll-reveal"
                    style="transition-delay: 0.3s">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-[#008000]/10 rounded-full mr-4">
                            <span class="text-2xl">✨</span>
                        </div>
                        <h2 class="text-3xl font-bold text-[#008000] dark:text-[#15803d]">
                            Our Vision
                        </h2>
                    </div>
                    <ul class="space-y-4 text-black dark:text-gray-300">
                        @foreach($aboutUs->visionPoints() as $point)
                        <li class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-[#15803d] flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span>{{ $point }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>


                <!-- Purpose Card -->
                <div class="p-8 bg-white dark:bg-gray-700 rounded-2xl shadow-lg border border-[#008000]/20 transition-transform hover:scale-102 scroll-reveal"
                    style="transition-delay: 0.4s">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-[#008000]/10 rounded-full mr-4">
                            <span class="text-2xl">🎯</span>
                        </div>
                        <h2 class="text-3xl font-bold text-[#008000] dark:text-[#15803d]">
                            Our Purpose
                        </h2>
                    </div>
                    <p class="leading-relaxed text-black dark:text-gray-300">
                        We exist to serve the purposes of God through worship, fellowship, discipleship, ministry, and
                        evangelism.
                        CITWAM is dedicated to empowering communities through the love and teachings of Christ while
                        meeting their tangible needs.
                    </p>
                </div>


                <!-- Core Values Card -->
                <div class="p-8 bg-white dark:bg-gray-700 rounded-2xl shadow-lg border border-[#008000]/20 transition-transform hover:scale-102 scroll-reveal"
                    style="transition-delay: 0.5s">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-[#008000]/10 rounded-full mr-4">
                            <span class="text-2xl">💎</span>
                        </div>
                        <h2 class="text-3xl font-bold text-[#008000] dark:text-[#15803d]">
                            Core Values
                        </h2>
                    </div>
                    <ul class="space-y-4 text-black dark:text-gray-300">
                        <li class="flex items-start space-x-3">
                            <span class="text-[#15803d] font-bold">•</span>
                            <span>Holiness</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-[#15803d] font-bold">•</span>
                            <span>Integrity</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-[#15803d] font-bold">•</span>
                            <span>Honesty</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-[#15803d] font-bold">•</span>
                            <span>Respect</span>
                        </li>
                    </ul>
                </div>


                <!-- Statement of Faith Card -->
                <div class="p-8 bg-white dark:bg-gray-700 rounded-2xl shadow-lg border border-[#008000]/20 transition-transform hover:scale-102 scroll-reveal"
                    style="transition-delay: 0.6s">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-[#008000]/10 rounded-full mr-4">
                            <span class="text-2xl">📖</span>
                        </div>
                        <h2 class="text-3xl font-bold text-[#008000] dark:text-[#15803d]">
                            Statement of Faith
                        </h2>
                    </div>
                    <ul class="space-y-4 text-black dark:text-gray-300">
                        <li class="flex items-start space-x-3"><span class="text-[#15803d] font-bold">•</span>
                            <span>The Bible is the inspired, authoritative Word of God.</span>
                        </li>
                        <li class="flex items-start space-x-3"><span class="text-[#15803d] font-bold">•</span>
                            <span>There is one God in three co-equal persons: Father, Son, and Holy Spirit.</span>
                        </li>
                        <li class="flex items-start space-x-3"><span class="text-[#15803d] font-bold">•</span>
                            <span>We believe in the deity and humanity of the Lord Jesus Christ.</span>
                        </li>
                        <li class="flex items-start space-x-3"><span class="text-[#15803d] font-bold">•</span>
                            <span>The universal sinfulness and guilt of human nature.</span>
                        </li>
                        <li class="flex items-start space-x-3"><span class="text-[#15803d] font-bold">•</span>
                            <span>Salvation is by grace through repentance.</span>
                        </li>
                        <li class="flex items-start space-x-3"><span class="text-[#15803d] font-bold">•</span>
                            <span>Baptism in the Holy Spirit with the evidence of speaking in tongues.</span>
                        </li>
                        <li class="flex items-start space-x-3"><span class="text-[#15803d] font-bold">•</span>
                            <span>Resurrection of the saved and the lost—eternal life or condemnation.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
