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
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('message.dashboard') }}
                        </x-nav-link>
                        @can('access users')
                            <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                                {{ __('Users') }}
                            </x-nav-link>
                        @endcan
                        @can('access students')
                            <x-nav-link :href="route('student.index')" :active="request()->routeIs('student.index')">
                                {{ __('bakid.t.students') }}
                            </x-nav-link>

                            <x-nav-link :href="route('student.new')" :active="request()->routeIs('student.new')">
                                {{ __('bakid.t.new_students') }}
                            </x-nav-link>
                        @endcan
                        @can('access settings')
                            <x-nav-link :href="route('setting.index')" :active="request()->routeIs('setting.index')">
                                {{ __('Settings') }}
                            </x-nav-link>
                        @endcan
                        @can(['access dormitories'])
                            <x-nav-link-group main="Manajemen" :items="[
                                // 'sub' => [
                                ['name' => 'Asrama', 'link' => route('dormitory.index')],
                                ['name' => 'Formal', 'link' => route('formal.index')],
                                ['name' => 'Non-Formal', 'link' => route('informal.index')],
                                // ],
                            ]" />
                            <x-nav-link-group main="Formal" :items="[
                                // 'sub' => [
                                ['name' => 'Asrama', 'link' => route('dormitory.index')],
                                ['name' => 'Formal', 'link' => route('formal.index')],
                                ['name' => 'Non-Formal', 'link' => route('informal.index')],
                                // ],
                            ]" />
                            <x-nav-link-group main="Non-Formal" :items="[
                                // 'sub' => [
                                ['name' => 'Asrama', 'link' => route('dormitory.index')],
                                ['name' => 'Formal', 'link' => route('formal.index')],
                                ['name' => 'Non-Formal', 'link' => route('informal.index')],
                                // ],
                            ]" />
                        @endcan
                        @hasrole('santri')
                            @if (Auth::user()->students->count() > 0)
                                <x-nav-link :href="route('student.families')" :active="request()->routeIs('student.families')">
                                    {{ __('message.family_member') }}
                                </x-nav-link>
                            @endif
                        @endhasrole
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="relative ml-3">
                        {{-- @if (\Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <x-splade-dropdown>
                                    <x-slot:trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                                {{ auth()->user()->currentTeam->name }}

                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                        </button>
                        </span>
                        </x-slot>

                        <div class="py-1 mt-2 bg-white rounded-md shadow-lg w-60 ring-1 ring-black ring-opacity-5">
                            <!-- Team Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-dropdown-link :href="route('teams.show', auth()->user()->currentTeam)">
                                {{ __('Team Settings') }}
                            </x-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-dropdown-link :href="route('teams.create')">
                                {{ __('Create New Team') }}
                            </x-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-200" />

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (auth()->user()->allTeams() as $team)
                            <x-splade-form method="PUT" :action="route('current-team.update')" :default="['team_id' => $team->getKey()]">
                                <x-dropdown-link as="button">
                                    <div class="flex items-center">
                                        @if ($team->is(auth()->user()->currentTeam))
                                        <svg class="w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        @endif

                                        <div>{{ $team->name }}</div>
                                    </div>
                                </x-dropdown-link>
                            </x-splade-form>
                            @endforeach
                        </div>
                        </x-splade-dropdown>
                        @endif --}}
                    </div>
                    {{-- TODO:#DROPDOWN --}}

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

                <!-- Hamburger -->
                <div class="flex items-center -mr-2 sm:hidden">
                    <button
                        class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500"
                        @click="mobileNavigation.open = ! mobileNavigation.open">
                        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': mobileNavigation.open, 'inline-flex': !mobileNavigation.open }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !mobileNavigation.open, 'inline-flex': mobileNavigation.open }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <nav class="z-50 fixed bottom-0 w-full h-auto bg-white shadow-lg sm:hidden">
        <div class="flex px-3 py-3">
            <!-- 5 menu utama -->
            <div class="grid grid-cols-5 w-full gap-1 text-xs">
                <x-navigation.admin-menu-item name="{{ __('Students') }}" :link="route('student.index')" icon="ph-user-list"
                    :active="request()->routeIs('student')" />
                <x-navigation.admin-menu-item name="{{ __('Search') }}" :link="route('student.index')" icon="ph-magnifying-glass"
                    :active="request()->routeIs('search')" />
                <x-navigation.admin-menu-item name="{{ __('Dashboard') }}" icon="ph-house-line" :active="request()->routeIs('dashboard')" />
                <x-navigation.admin-menu-item name="{{ __('Announcement') }}" :link="route('student.index')" icon="ph-broadcast"
                    :active="request()->routeIs('annoucement')" />
                <x-navigation.admin-menu-item name="Menu" :link="route('student.index')" icon="ph-user-circle"
                    :active="request()->routeIs('profile')" />
            </div>
        </div>
    </nav>


</x-splade-rehydrate>
