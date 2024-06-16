@seoTitle(__('Settings'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Settings') }}
        </h2>
    </x-slot:header>

    <div class="py-12 px-4 max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="text-xl text-center text-white font-semibold uppercase mb-3">PENGAJUAN</div>
        <x-card-container>
            <div class="flex justify-center items-center gap-3 mb-6">
                <div class="p-1 px-4 rounded-xl border bg-primary-500 text-white">Pindah Kamar</div>
            </div>
            <x-splade-table :for="$users" />
        </x-card-container>
    </div>
</x-app-layout>
