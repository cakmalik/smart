    <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line" :link="route('dashboard')"
        :active="request()->routeIs('dashboard')" />

    @can('access campaign')
        <x-navigation.admin-menu-component name="{{ __('Announcement') }}" icon="ph-megaphone" :link="route('announcement.index')"
            :active="request()->routeIs('announcement.index')" />
    @endcan

    {{-- cek route --}}
    @can('access psb')
        <x-navigation.admin-menu-component name="{{ __('PSB') }}" icon="ph-user-circle-plus" link="" :active="request()->routeIs(['student.new'])"
            :submenu="[
                ['name' => 'Santri Baru', 'link' => route('student.new')],
                ['name' => 'Rekap pembayaran', 'link' => route('invoice.index')],
            ]" />
    @endcan


    @can('access students')
        <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-users" :link="route('student.index')"
            :active="request()->routeIs('student.index')" />
    @endcan

    @can('access alumni')
        <x-navigation.admin-menu-component name="{{ __('Alumni') }}" icon="ph-users" :link="route('student.alumni')" :active="request()->routeIs('student.alumni')" />
    @endcan

    @can('access management')
        <x-navigation.admin-menu-component name="{{ __('Management') }}" icon="ph-coffee" link="" :active="request()->routeIs(['dormitory.index', 'formal.index', 'informal.index', 'mutation.index'])"
            :submenu="[
                ['name' => 'Asrama', 'link' => route('dormitory.index')],
                ['name' => 'Pendidikan Formal', 'link' => route('formal.index')],
                ['name' => 'Pendidikan Non-Formal', 'link' => route('informal.index')],
            ]" />
    @endcan


    @can('access mutation')
        <x-navigation.admin-menu-component name="{{ __('Mutation') }}" icon="ph-arrows-left-right" link=""
            :active="request()->routeIs()" :submenu="[
                ['name' => 'Kelola Mutasi', 'link' => route('mutation.index')],
                ['name' => 'Mutation History', 'link' => route('mutation.history')],
            ]" />
    @endcan

    @can('access approval')
        <x-navigation.admin-menu-component name="{{ __('Approval') }}" icon="ph-check-circle" link="" :active="request()->routeIs(['approval.index'])"
            :submenu="[
                ['name' => 'Dropout (on progress)', 'link' => route('approval.index', 'dropout')],
                ['name' => 'Asrama', 'link' => route('approval.index', 'asrama')],
                ['name' => 'Formal', 'link' => route('approval.index', 'formal')],
                ['name' => 'Nonformal', 'link' => route('approval.index', 'nonformal')],
            ]" />
    @endcan

    @can('access invoice')
        <x-navigation.admin-menu-component name="{{ 'Invoice' }}" icon="ph-money" link="" :active="request()->routeIs(['invoice.index', 'invoice.categories'])"
            :submenu="[
                ['name' => __('All Invoice'), 'link' => route('invoice.index')],
                ['name' => __('Category'), 'link' => route('invoice.categories')],
            ]" />
    @endcan

    @can('access in_out_permit')
        <x-navigation.admin-menu-component name="{{ __('Permittion') }}" icon="ph-house-line" :link="route('permittion.index')"
            :active="request()->routeIs('permittion')" />
    @endcan

    @can('access violation')
        <x-navigation.admin-menu-component name="{{ __('Violation') }}" icon="ph-house-line" :link="route('violation.index')"
            :active="request()->routeIs('violation')" />
    @endcan

    @can('access users')
        <x-navigation.admin-menu-component name="{{ __('User') }}" icon="ph-megaphone" :link="route('user.index')"
            :active="request()->routeIs('user.index')" />
    @endcan

    @can('access settings')
        <x-navigation.admin-menu-component name="{{ __('Settings') }}" icon="ph-gear-six" :link="route('setting.index')"
            :active="request()->routeIs('setting.index')" />
    @endcan
