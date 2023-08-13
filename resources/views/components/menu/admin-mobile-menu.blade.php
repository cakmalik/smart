<x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line" :link="route('dashboard')"
    :active="request()->routeIs('dashboard')" />
<x-navigation.admin-menu-component name="{{ __('Announcement') }}" icon="ph-house-line" :link="route('announcement.index')"
    :active="request()->routeIs('announcement.index')" />
<x-navigation.admin-menu-component name="{{ __('Asrama') }}" icon="ph-house-line" link="" :active="request()->routeIs('dormitory.index')"
    :submenu="[
        ['name' => 'Asrama', 'link' => route('dormitory.index')],
        ['name' => 'Formal', 'link' => route('formal.index')],
        ['name' => 'Non-Formal', 'link' => route('informal.index')],
    ]" />
