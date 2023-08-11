@hasrole('santri')
    @if (Auth::user()->students->count() > 0)
        <x-navigation.santri-mobile-menu />
    @endif
@else
    <x-navigation.admin-menu />
@endhasrole
