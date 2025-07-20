<header
    class="sticky top-0 flex w-full bg-white xl:z-[999] max-xl:z-[9999] drop-shadow-1 dark:bg-box-dark dark:drop-shadow-none min-h-[70px]">
    <!-- Navigation -->
    <div
        class="flex flex-1 nav-wrap md:ps-[20px] ps-[30px] pe-[30px] max-xs:ps-[15px] max-xs:pe-[15px] bg-white dark:bg-box-dark">
        <!-- Header left menu -->

        <ul class="flex items-center mb-0 list-none nav-left ps-0 gap-x-[14px] gap-y-[9px]">
            <!-- Navigation Items -->
            <li class="xl:hidden xl:[&.flex]:flex" id="topMenu-logo">
                <div
                    class="flex md:w-[190px] xs:w-[170px] max-xs:w-[100px] max-md:pe-[30px] max-xs:pe-[15px] border-e border-[#edf2f9] dark:border-box-dark-up logo-wrapper items-center h-[71px] dark:bg-box-dark-up">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
            </li>
            <li>
                <a class="flex items-center justify-center sm:min-w-[40px] sm:w-[40px] sm:h-[40px] min-w-[34px] h-[34px] rounded-full bg-transparent hover:bg-primary/10 hover:text-primary dark:hover:text-title-dark dark:hover:bg-box-dark-up group transition duration-200 ease-in-out text-[#525768] dark:text-subtitle-dark max-md:dark:hover:bg-box-dark-up sm:text-[20px] text-[19px] cursor-pointer xl:[&.hide]:hidden max-md:bg-normalBG max-md:dark:bg-box-dark-up max-md:dark:hover:text-subtitle-dark"
                    id="slim-toggler">
                    <i class="uil uil-align-center-alt text-current [&.is-folded]:hidden flex items-center"></i>
                </a>
            </li>
        </ul>
        <!-- Header right menu -->

        <div class="flex items-center ms-auto py-[15px] sm:gap-x-[25px] max-sm:gap-x-[15px] gap-y-[15px] relative">

            <div class="relative">
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">
                    <span
                    class="nav-icon dark:text-subtitle-dark text-[18px] text-light-extra  group-hover:text-current group-[&.active]:text-current group-focus:text-current">
                    <i class="uil uil-exchange"></i>
                </span>
                </a>                
            </div>

            <button type="button"
                class="flex xl:hidden items-center text-[22px] text-[#a0a0a0] dark:text-subtitle-dark min-h-[40px]"
                id="author-dropdown">
                <i class="uil uil-ellipsis-v text-[18px]"></i>
            </button>
            <ul id="right-ellipsis-trigger"
                class="xl:flex hidden items-center justify-end flex-auto mb-0 list-none ps-0 sm:gap-x-[25px] max-sm:gap-x-[15px] gap-y-[15px] max-xl:absolute max-xl:z-[1000] max-xl:m-0 max-xl:rounded-lg max-xl:border-none max-xl:bg-white max-xl:bg-clip-padding max-xl:text-left max-xl:shadow-lg max-xl:dark:bg-neutral-700 max-xl:[&.active]:flex max-xl:end-0 max-xl:px-[20px] max-sm:px-[15px] max-xl:py-[10px] max-xl:top-[70px]">
                <li>

                    <div class="relative" data-te-dropdown-ref>
                        <button id="message" data-te-dropdown-toggle-ref aria-expanded="false" type="button"
                            class="flex items-center text-[22px] text-[#a0a0a0] dark:text-subtitle-dark relative min-h-[40px] group">
                            <i class="uil uil-envelope"></i>
                            <span
                                class="absolute flex w-1.5 h-1.5 translate-x-2/4 -translate-y-2/4 origin-[100%_0%] end-[3px] top-[8px] group-[[data-te-dropdown-show]]:hidden">
                                <span
                                    class="absolute inline-flex w-full h-full rounded-full opacity-75 animate-ping bg-success/20"></span>
                                <span class="relative inline-flex w-1.5 h-1.5 rounded-full bg-success"></span>
                            </span>
                        </button>
                        <div aria-labelledby="message" data-te-dropdown-menu-ref
                            class="absolute z-[1000] ltr:float-left rtl:float-right m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-clip-padding text-left text-base shadow-lg dark:shadow-boxLargeDark [&[data-te-dropdown-show]]:block">
                            <div
                                class="bg-white dark:bg-box-dark shadow-[0_2px_8px_rgba(0,0,0,.15)] dark:shadow-[0_5px_30px_rgba(1,4,19,.60)] rounded-4 px-[15px] py-[12px] md:min-w-[380px] sm:w-[300px] max-sm:w-[230px]">
                                <h1
                                    class="flex items-center justify-center text-sm rounded-md bg-section dark:bg-box-dark-up h-[50px] p-[10px] text-dark dark:text-title-dark font-semibold">
                                    <span class="title-text">
                                        Messages
                                        <span
                                            class="inline-flex items-center justify-center w-5 h-5 text-xs text-white rounded-full ms-[8px] bg-success dark:text-title-dark">
                                            3
                                        </span>
                                    </span>
                                </h1>
                                <ul class="p-0 max-h-[250px] relative overflow-x-hidden overflow-y-auto scrollbar">

                                    <li class="w-full">
                                        <div
                                            class="group relative block w-full px-3 sm:py-3.5 max-sm:py-1.5 text-body dark:text-subtitle-dark transition-[0.3s] hover:text-primary hover:bg-white dark:hover:bg-white/[.06] hover:shadow-custom dark:shadow-none dark:hover:shadow-[0_5px_30px_rgba(1,4,19,.20)] dark:rounded-4">
                                            <figure
                                                class="inline-flex w-full mb-0 align-top sm:gap-x-[16px] gap-y-[8px] max-sm:flex-wrap">
                                                <div
                                                    class="text-light w-[40px] min-w-[40px] h-[40px] rounded-full relative">
                                                    <span
                                                        class="bg-current absolute content-[''] w-[12px] h-[12px] rounded-full border-2 border-white right-0 bottom-0"
                                                        *ngif="!messages.isRead"></span>
                                                    <img class="object-cover w-[40px] h-[40px] bg-light-extra rounded-full"
                                                        src="images/messages/app-developer.png">
                                                </div>
                                                <figcaption class="w-full -mt-1 text-start">
                                                    <h1
                                                        class="flex items-center justify-between mb-0.5 text-sm text-current font-semibold">
                                                        App developer
                                                        <span class="text-xs font-normal text-text-light">2.5 hrs
                                                            ago</span>
                                                    </h1>
                                                    <div class="flex items-center gap-[30px] text-start">
                                                        <span
                                                            class="ps-0 min-w-[216px] text-body dark:text-subtitle-dark">Lorem
                                                            ipsum
                                                            dolor amet cosec...</span>
                                                        <span
                                                            class="inline-flex items-center justify-center w-4 h-4 text-white rounded-full bg-light dark:text-white/[.87 text-10">3</span>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </li>

                                </ul>
                                <a class="flex items-center justify-center text-[13px] font-medium bg-normalBG dark:bg-box-dark-up h-[50px] text-light hover:text-primary dark:hover:text-subtitle-dark dark:text-title-dark mx-[-15px] mb-[-15px] rounded-b-6"
                                    href="#">
                                    See all messages
                                </a>
                            </div>
                        </div>
                    </div>

                </li>


                <li>

                    <div class="relative" data-te-dropdown-ref>
                        <button type="button" id="notification" data-te-dropdown-toggle-ref aria-expanded="false"
                            class="flex items-center hs-dropdown-toggle text-[23px] text-[#a0a0a0] dark:text-subtitle-dark relative min-h-[40px] group">
                            <i class="uil uil-bell"></i>
                            <span
                                class="absolute flex w-1.5 h-1.5 translate-x-2/4 -translate-y-2/4 origin-[100%_0%] end-[3px] top-[8px] group-[[data-te-dropdown-show]]:hidden">
                                <span
                                    class="absolute inline-flex w-full h-full rounded-full opacity-75 animate-ping bg-warning/20"></span>
                                <span class="relative inline-flex w-1.5 h-1.5 rounded-full bg-warning"></span>
                            </span>
                        </button>
                        <div aria-labelledby="notification" data-te-dropdown-menu-ref
                            class="absolute z-[1000] ltr:float-left rtl:float-right m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:shadow-boxLargeDark dark:bg-box-dark-down  [&[data-te-dropdown-show]]:block">
                            <div
                                class="bg-white dark:bg-box-dark shadow-[0_2px_8px_rgba(0,0,0,.15)] dark:shadow-[0_5px_30px_rgba(1,4,19,.60)] rounded-4 px-[15px] py-[12px] md:min-w-[400px] sm:w-[300px] max-sm:w-[230px]">
                                <h1
                                    class="flex items-center justify-center text-sm rounded-md bg-section dark:bg-box-dark-up h-[50px] p-[10px] text-dark dark:text-title-dark font-semibold">
                                    <span class="title-text me-2.5">Notifications<span
                                            class="inline-flex items-center justify-center w-5 h-5 text-xs text-white rounded-full bg-warning ms-3 dark:text-title-dark">3</span></span>
                                </h1>

                                <ul class="p-0 max-h-[250px] relative overflow-x-hidden overflow-y-auto scrollbar">
                                    <li class="w-full sm:mb-0 mb-[10px]">
                                        <button
                                            class="group relative block w-full px-3 sm:py-3.5 max-sm:py-1.5 text-body dark:text-subtitle-dark hover:bg-white dark:hover:bg-box-dark-up hover:shadow-custom dark:shadow-none dark:rounded-4">
                                            <div
                                                class="flex items-start gap-x-[15px] gap-y-[5px] flex-wrap max-xs:flex-col">
                                                <div
                                                    class="flex items-center justify-center rounded-full w-[30px] h-[30px] bg-primary/10 text-primary">
                                                    <i class="text-current uil uil-inbox text-[16px]"></i>
                                                </div>
                                                <div class="flex items-center justify-between flex-1">
                                                    <div class="text-start">
                                                        <h1
                                                            class="flex items-center justify-between mb-0.5 text-[#5a5f7d] dark:text-title-dark text-sm font-normal flex-wrap">
                                                            <span class="text-primary me-1.5 font-medium">Shamim
                                                                Ahmed</span>
                                                            sent you a message
                                                        </h1>
                                                        <p class="mb-0 text-xs text-body dark:text-subtitle-dark">
                                                            3 hours ago
                                                        </p>
                                                    </div>
                                                    <div><span
                                                            class="inline-flex items-center justify-center bg-primary w-1.5 h-1.5 ms-3 rounded-full"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </li>
                                </ul>
                                <a class="flex items-center justify-center text-[13px] font-medium bg-normalBG dark:bg-box-dark-up h-[50px] text-light hover:text-primary dark:hover:text-subtitle-dark dark:text-title-dark mx-[-15px] mb-[-15px] rounded-b-6"
                                    href="#">See all incoming activity</a>

                            </div>
                        </div>
                    </div>

                </li>

                <li class="relative">
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" type="button"
                            class="flex items-center gap-2 p-2 transition-colors duration-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="object-cover w-8 h-8 rounded-full"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                <span class="hidden font-medium text-gray-700 dark:text-gray-200 md:block">
                                    {{ Auth::user()->name }}
                                </span>
                            @endif
                            <svg class="w-4 h-4 transition-transform duration-200 hidden md:block"
                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-50 w-64 mt-2 origin-top-right bg-white rounded-lg shadow-lg dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                            <div class="py-2">
                                <!-- Profile -->
                                {{-- <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" --}}
                                 <x-responsive-nav-link href="{{ route(config('app.admin_prefix') . '.profile.index') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>

                                <!-- API Tokens -->
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')"
                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                        <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                        </svg>
                                        {{ __('API Tokens') }}
                                    </x-responsive-nav-link>
                                @endif

                                <!-- Logout -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                    <x-responsive-nav-link href="{{ route('logout') }}" wire:navigate
                                        @click.prevent="$root.submit();"
                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                        <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>

                                

                                <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>

                                    <div class="px-4 py-2 text-xs font-semibold text-gray-400 dark:text-gray-500">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-responsive-nav-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                        :active="request()->routeIs('teams.show')"
                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                        <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ __('Team Settings') }}
                                    </x-responsive-nav-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                            <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            {{ __('Create New Team') }}
                                        </x-responsive-nav-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>

                                        <div class="px-4 py-2 text-xs font-semibold text-gray-400 dark:text-gray-500">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>

    </div>
    <!-- End: Navigation -->
</header>
