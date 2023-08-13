<x-splade-data store="mobileNavigation" default="{ open: false }" />

<x-splade-rehydrate on="refresh-navigation-menu, profile-information-updated">
    <nav class="hidden sm:block border-b border-gray-100 bg-white/70">
        <!-- Primary Navigation Menu -->
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex items-center shrink-0">
                        <Link href="{{ route('dashboard') }}">
                        <x-application-mark class="block w-auto h-9" />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <x-menu.admin-desk-menu/>

                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="relative ml-3">
                    </div>
                    <div class="relative ml-3">
                        <button
                            class="relative flex items-center justify-center w-8 h-8 p-1 bg-transparent border border-indigo-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#a5b4fc" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="none" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                            <div class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></div>
                        </button>
                    </div>
                    <!-- Settings Dropdown -->
                    <div class="relative ml-3">
                        <x-splade-dropdown>
                            <x-slot:trigger>
                                @if (\Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                        <img class="object-cover w-8 h-8 bg-green-400 rounded-full"
                                            src="{{ auth()->user()->profile_photo_url }}"
                                            alt="{{ auth()->user()->name }}">
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
                                    class="w-48 py-1 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('message.manage_account') }}
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
                                            {{ __('message.sign_out') }}
                                        </x-dropdown-link>
                                    </x-splade-form>
                                </div>
                        </x-splade-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @include('components.navigation.mobile.layout')


</x-splade-rehydrate>
