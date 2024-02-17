<ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-4 rtl:space-x-reverse">
    <x-menu.web link="{{ route('dashboard') }}" label="Home" />
    <x-menu.web link="{{ route('dashboard') }}" label="Home" />
    <x-menu.web link="{{ route('dashboard') }}" label="Home" />
    <x-menu.web link="{{ route('announcement.index') }}" label="Announcement" />
    <x-menu.web-mega cols="1" label="PSB" >
        <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
            <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                <x-menu.web link="{{ route('student.new') }}" label="Santri Baru" icon="ph-plus-circle" />
                <x-menu.web link="{{ route('invoice.index') }}" label="Rekap pembayaran" icon="ph-plus-circle" />
            </ul>
        </div>
    </x-menu.web-mega>
    <x-menu.web link="{{ route('student.index') }}" label="Students" />
    <x-menu.web link="{{ route('student.alumni') }}" label="Alumni" />
    <x-menu.web-mega cols="2" label="Management" >
        <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
            <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                <x-menu.web link="{{ route('dormitory.index') }}" label="Asrama" icon="ph-plus-circle" />
                <x-menu.web link="{{ route('formal.index') }}" label="Pendidikan Formal" icon="ph-plus-circle" />
                <x-menu.web link="{{ route('informal.index') }}" label="Pendidikan Non-Formal" icon="ph-plus-circle" />
            </ul>
        </div>
        <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
            <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                <x-menu.web link="{{ route('mutation.index') }}" label="Kelola Mutasi" icon="ph-plus-circle" />
                <x-menu.web link="{{ route('mutation.history') }}" label="Mutation History" icon="ph-plus-circle" />
            </ul>
        </div>
    </x-menu.web-mega>
    <x-menu.web-mega cols="1" label="Approval" >
        <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
            <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                <x-menu.web link="{{ route('approval.index', 'dropout') }}" label="Dropout (on progress)" icon="ph-plus-circle" />
                <x-menu.web link="{{ route('approval.index', 'asrama') }}" label="Asrama" icon="ph-plus-circle" />
                <x-menu.web link="{{ route('approval.index', 'formal') }}" label="Formal" icon="ph-plus-circle" />
                <x-menu.web link="{{ route('approval.index', 'nonformal') }}" label="Nonformal" icon="ph-plus-circle" />
            </ul>
        </div>
    </x-menu.web-mega>

    <x-menu.web-mega cols="1" label="Invoice" >
        <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
            <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                <x-menu.web link="{{ route('invoice.index') }}" label="All Invoice" icon="ph-plus-circle" />
                <x-menu.web link="{{ route('invoice.categories') }}" label="Category" icon="ph-plus-circle" />
            </ul>
        </div>
    </x-menu.web-mega>
    
    <x-menu.web link="{{ route('permittion.index') }}" label="Permittion" />
    <x-menu.web link="{{ route('violation.index') }}" label="Violation" />
    <x-menu.web link="{{ route('user.index') }}" label="Users" />
    <x-menu.web link="{{ route('setting.index') }}" label="Settings" />

</ul>
