<x-banner />

<div class="min-h-screen pb-20 relative overflow-scroll"
    style="background-image: url('{{ asset('bg/' . env('CURRENT_BACKGROUND') . '.jpg') }}'); background-size: cover; background-position: center;background-attachment: fixed;">
    {{-- <div class="min-h-screen bg-neutral-200"> --}}

    @hasrole('santri')
        @if (Auth::user()->students->count() > 0)
            <x-navigation.santri-mobile-menu />
        @endif
    @else
        <x-splade-data store="mobileNavigation" default="{ open: false }" />
        {{-- MENU WEB --}}
        <nav class="z-900 sm:absolute w-full h-[100px] hidden sm:block malik-bg   border-gray-200 dark:bg-gray-900">
            <div class="flex flex-wrap items-center justify-center max-w-screen-xl mx-auto pt-4">
                <a href="https://bakid.id" class="flex  items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('bakid/logo-ppmu.png') }}" class="h-8" alt="Flowbite Logo" />
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name') }}</span>
                </a>
            </div>
            <div class="flex flex-wrap items-center justify-center max-w-screen-xl mx-auto p-4 overflow-x-scroll">
                <div id="mega-menu-icons" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                    <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                        <div id="mega-menu-icons" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                            @include('components.menu.admin-web-menu')
                         </div>
                    </ul>
                </div>
            </div>
        </nav>
        
        <x-splade-rehydrate on="refresh-navigation-menu, profile-information-updated">
            @include('components.navigation.mobile.layout')
        </x-splade-rehydrate>
    
    @endhasrole


    <!-- Page Heading -->
    @isset($header)
        <header class="z-800 absolute sm:top-[100px] w-full text-center sm:text-start shadow bg-wa-teal2/60  backdrop-filter backdrop-blur-lg ">
            <div class="max-w-7xl mx-auto py-3  px-4 sm:px-6 lg:px-8 text-white">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3 w-full">
                        @hasrole('santri')
                            <img src="{{ asset('bakid/logo-ppmu.png') }}" alt="Logo" class="w-10 h-10 " />
                        @else
                            <img src="{{ asset('bakid/logo-ppmu.png') }}" alt="Logo" class="w-10 h-10 sm:hidden" />
                        @endhasrole
                        {{-- disini tempat page title --}}
                        <div class="flex w-full justify-between items-center">
                            {{ $header }}
                            {{-- bagian avatar dropdown --}}
                            <div class="flex items-center gap-2">
                                <a href="{{ route('setting.switch-locale') }}"
                                    class="uppercase font-semibold text-white">{{ config('app.locale') }}
                                </a>
                                <x-splade-dropdown>
                                    <x-slot:trigger>
                                        @if (\Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <button
                                                class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                                <img class="object-cover w-8 h-8 bg-green-400 rounded-full"
                                                    src="{{ auth()->user()?->profile_photo_url }}"
                                                    alt="{{ auth()->user()?->name }}">
                                            </button>
                                        @else
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                                    {{ auth()->user()->name }}
                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4.5 12.75l6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        @endif
                                    </x-slot>
                                    <div
                                        class="w-48 py-1 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('manage_account') }}
                                        </div>
                                        <x-dropdown-link :href="route('profile.show')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        @hasrole('admin')
                                            @if (\Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-dropdown-link :href="route('api-tokens.index')">
                                                    {{ __('API Tokens') }}
                                                </x-dropdown-link>
                                            @endif
                                        @endhasrole
                                        <div class="border-t border-gray-200" />
                                        <!-- Authentication -->
                                        <x-splade-form :action="route('logout')">
                                            <x-dropdown-link as="button">
                                                {{ __('Sign out') }}
                                            </x-dropdown-link>
                                        </x-splade-form>
                                    </div>
                                </x-splade-dropdown>

                            </div>

                        </div>
                    </div>
                    <div class=" sm:hidden flex gap-3">
                        @if (roleName() == 'santri')
                            <Link confirm="Apakah yakin keluar?" confirm-button="Ya!" cancel-button="Tidak"
                                href="{{ route('logout') }}" method="post">
                            <i class="ph-fill ph-sign-out text-base rounded-full  p-1"></i>
                            </Link>
                        @endif
                    </div>
                </div>
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="absolute w-full top-[30px] sm:top-[150px]">
            {{ $slot }}
        </main>

        <x-splade-script>
            initFlowbite();
        </x-splade-script>
    </div>
