<Menu>
    <div class="grid grid-cols-3 gap-1 ">
        <x-menu.new.single-menu link="{{ route('dashboard') }}" label="Home" icon="ph-house" />
        @can('access announcement')
            <x-menu.new.single-menu link="{{ route('announcement.index') }}" label="Announcement" icon="ph-megaphone-simple" />
        @endcan

        @can('access psb')
            <x-menu.new.submenu label="PSB" icon="ph-user-plus">
                <x-menu.new.li link="{{ route('student.new') }}" label="Santri Baru" />
                <x-menu.new.li link="{{ route('invoice.index') }}" label="Rekap pembayaran" />
                <x-menu.new.li link="{{ route('admission.settings') }}" label="Pengaturan PSB" />
            </x-menu.new.submenu>
        @endcan


        @can('access students')
            <x-menu.new.single-menu link="{{ route('student.index') }}" label="Students" icon="ph-users"/>
        @endcan

        @can('access alumni')
            <x-menu.new.single-menu link="{{ route('student.alumni') }}" label="Alumni" icon="ph-graduation-cap"/>
        @endcan

        @can('access management')
            <x-menu.new.submenu label="Management" icon="ph-diamonds-four">
                <x-menu.new.li link="{{ route('dormitory.index') }}" label="Asrama" />
                <x-menu.new.li link="{{ route('formal.index') }}" label="Pendidikan Formal" />
                <x-menu.new.li link="{{ route('informal.index') }}" label="Pendidikan Non-Formal" />
                <x-menu.new.li link="{{ route('mutation.index') }}" label="Kelola Mutasi" />
                <x-menu.new.li link="{{ route('mutation.history') }}" label="Riwayat Mutasi" />
            </x-menu.new.submenu>
        @endcan

        @can('access invoice')
            <x-menu.new.submenu label="Invoice" icon="ph-currency-dollar">
                <x-menu.new.li link="{{ route('invoice.index') }}" label="All Invoice"/>
                @can('access invoice_categories')
                    <x-menu.new.li link="{{ route('invoice.categories') }}" label="Category"/>
                @endcan
            </x-menu.new.submenu>
        @endcan

        @can('access permit')
            <x-menu.new.single-menu link="{{ route('permittion.index') }}" label="Permittion" icon="ph-arrows-left-right"/>
        @endcan

        @can('access violation')
            <x-menu.new.single-menu link="{{ route('violation.index') }}" label="Violation" icon="ph-scales"/>
        @endcan

        {{-- @can('access users')
        <x-menu.new.single-menu link="{{ route('user.index') }}" label="Users" icon="ph-fsdf"/>
    @endcan --}}

        @can('access settings')
            <x-menu.new.single-menu link="{{ route('setting.index') }}" label="Settings" icon="ph-gear-six"/>
        @endcan

        @can('access export')
            <x-menu.new.single-menu link="{{ route('export.index') }}" label="Export" icon="ph-download-simple"/>
        @endcan
        
        <div class="">
            <button id="dropdownHoverButtonProfile" data-dropdown-toggle="dropdownHoverProfile"
                data-dropdown-trigger="hover" type="button"
                class="flex flex-col gap-2 w-24 p-2 items-center rounded-lg text-center group cursor-pointer ">
                <img class="object-cover w-12 h-12 bg-green-400 rounded-full"
                                 src="{{ auth()->user()?->profile_photo_url }}" alt="{{ auth()->user()?->name }}">
            </button>
            <div id="dropdownHoverProfile"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownHoverButtonProfile">
                    <li>
                        <Link href="{{ route('profile.show') }}"
                            class="block px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <span class="sr-only">Profile</span>
                            {{-- @if ($icon != null)
                                <i class="text-sm me-2 ph {{ $icon }}"></i>
                            @endif --}}
                            Profile
                        </Link>
                    </li>
                    <li>
                        <Link  href="{{ route('logout') }}" method="post"
                            class="block px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <span class="sr-only">Keluar</span>
                            {{-- @if ($icon != null)
                                <i class="text-sm me-2 ph {{ $icon }}"></i>
                            @endif --}}
                            Keluar
                        </Link>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <x-splade-script>
        initFlowbite();
    </x-splade-script>
</Menu>
