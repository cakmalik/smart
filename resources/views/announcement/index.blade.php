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
            <Link class="py-2 px-3 rounded-lg border capitalize bg-wa-light" href="{{ route('announcement.create') }}">
            {{ __('create announcement') }}
            </Link>
            <div class="mt-3">
                <x-splade-table :for="$data" striped>
                    <x-slot name="empty-state">
                        <div class="flex flex-col">
                            <lottie-player src="https://lottie.host/e1929754-8ae8-40ae-af73-de3d132e5fb6/ZVkbeMfTvv.json"
                                background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                autoplay></lottie-player>
                            <p class="text-center">Tidak ditemuka data.</p>
                        </div>
                    </x-slot>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
