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
        <div class="mx-2 sm:mx-auto max-w-7xl sm:px-6 lg:px-8 ">
            <div class="flex justify-center">
                <Link class="py-2 px-3 rounded-lg border capitalize bg-wa-light text-white"
                    href="{{ route('announcement.create') }}">
                <i class="ph ph-plus"></i>
                {{ __('add') }}
                </Link>
            </div>
            <div class="mt-3">
                <x-splade-table :for="$data" striped>
                    <x-slot name="empty-state">
                        <div class="flex flex-col">
                            <lottie-player
                                src="https://lottie.host/e1929754-8ae8-40ae-af73-de3d132e5fb6/ZVkbeMfTvv.json"
                                background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                autoplay></lottie-player>
                            <p class="text-center">Tidak ditemuka data.</p>
                        </div>
                    </x-slot>
                    @cell('action', $data)
                        <div class="flex gap-1 ">
                            <Link confirm method="DELETE" href="{{ route('announcement.destroy', $data->id) }}"
                                class="rounded-full p-1 px-2 capitalize bg-red-200 text-red-500 hover:bg-red-500 hover:text-white">
                            {{ __('delete') }}
                            </Link>
                        </div>
                    @endcell
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
