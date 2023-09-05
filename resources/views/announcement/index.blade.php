@seoTitle(__('Announcement'))

<x-app-layout>
    <x-slot:header>
        <div class="flex items-center gap-3">

            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Announcement') }}
            </h2>
        </div>
        @hasrole('santri')
            <Link confirm="Apakah yakin keluar?" confirm-button="Ya!" cancel-button="Tidak" href="{{ route('logout') }}"
                method="post">
            <i class="ph-fill ph-sign-out"></i>
            </Link>
        @endhasrole
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 ">
        </div>
    </div>
</x-app-layout>
