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
    </div>

    <x-splade-script>
        initFlowbite();
    </x-splade-script>
</Menu>
