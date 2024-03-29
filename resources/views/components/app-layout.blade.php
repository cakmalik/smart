<x-banner />

<div class="min-h-screen bg-green-200 pb-20"
    style="background-image: url('{{ asset('bg/' . env('CURRENT_BACKGROUND') . '.jpg') }}'); background-size: cover; background-position: center;background-attachment: fixed;">
{{-- <div class="min-h-screen bg-neutral-200"> --}}

    <x-navigation />

    <!-- Page Heading -->
    @isset($header)
        <header class="text-center sm:text-start shadow bg-wa-teal2  backdrop-filter backdrop-blur-lg">
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
                                    <div class="w-48 py-1 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
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
        <main>
            {{ $slot }}
        </main>
    </div>
