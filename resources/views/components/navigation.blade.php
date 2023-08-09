@hasrole('santri')
    @if (Auth::user()->students->count() > 0)
        <x-navigation.mobile />
    @endif
@else
    <x-navigation.admin-menu />

@endhasrole
