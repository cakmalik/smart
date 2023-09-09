<x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line" :link="route('dashboard')"
    :active="request()->routeIs('dashboard')" />
<x-navigation.admin-menu-component name="{{ __('Announcement') }}" icon="ph-megaphone" :link="route('announcement.index')"
    :active="request()->routeIs('announcement.index')" />

{{-- cek route --}}
<x-navigation.admin-menu-component name="{{ __('PSB') }}" icon="ph-user-circle-plus" link="" :active="request()->routeIs(['student.new', 'invoice.index'])"
    :submenu="[
        ['name' => 'Santri Baru', 'link' => route('student.new')],
        ['name' => 'Rekap pembayaran', 'link' => route('invoice.index')],
    ]" />

<x-navigation.admin-menu-component name="{{ __('Management') }}" icon="ph-coffee" link="" :active="request()->routeIs(['dormitory.index', 'formal.index', 'informal.index', 'mutation.index'])"
    :submenu="[
        ['name' => 'Asrama', 'link' => route('dormitory.index')],
        ['name' => 'Pendidikan Formal', 'link' => route('formal.index')],
        ['name' => 'Pendidikan Non-Formal', 'link' => route('informal.index')],
        ['name' => 'Mutasi', 'link' => route('mutation.index')],
    ]" />
<x-navigation.admin-menu-component name="{{ __('Approval') }}" icon="ph-check-circle" link="" :active="request()->routeIs(['approval.index'])"
    :submenu="[
        ['name' => 'Dropout', 'link' => route('approval.index', 'dropout')],
        ['name' => 'Asrama', 'link' => route('approval.index', 'asrama')],
        ['name' => 'Formal', 'link' => route('approval.index', 'formal')],
        ['name' => 'Nonformal', 'link' => route('approval.index', 'nonformal')],
    ]" />
<x-navigation.admin-menu-component name="{{ __('User') }}" icon="ph-megaphone" :link="route('user.index')"
    :active="request()->routeIs('user.index')" />
