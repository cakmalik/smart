<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('message.dashboard') }}
    </x-nav-link>

    @can('access students')
        <x-nav-link :href="route('student.index')" :active="request()->routeIs('student.index')">
            {{ __('bakid.t.students') }}
        </x-nav-link>
    @endcan
    @can('access admission')
        <x-nav-link-group main="PSB" :items="[
            ['name' => 'Santri baru', 'link' => route('student.new')],
            ['name' => 'Rekap pembayaran', 'link' => route('invoice.index')],
        ]" />
    @endcan

    @can(['access dormitories'])
        <x-nav-link-group main="Manajemen" :items="[
            // 'sub' => [
            ['name' => 'Asrama', 'link' => route('dormitory.index')],
            ['name' => 'Formal', 'link' => route('formal.index')],
            ['name' => 'Non-Formal', 'link' => route('informal.index')],
            ['name' => 'Mutasi', 'link' => route('mutation.index')],
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

    @can('access users')
        <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
            {{ __('Users') }}
        </x-nav-link>
    @endcan

    @can('access settings')
        <x-nav-link :href="route('setting.index')" :active="request()->routeIs('setting.index')">
            {{ __('Settings') }}
        </x-nav-link>
    @endcan

    @hasrole('santri')
        @if (Auth::user()->students->count() > 0)
            <x-nav-link :href="route('student.families')" :active="request()->routeIs('student.families')">
                {{ __('message.family_member') }}
            </x-nav-link>
        @endif
    @endhasrole
</div>
