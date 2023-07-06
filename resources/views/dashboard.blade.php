@seoTitle(__('Dashboard'))

<x-app-layout>
    <x-slot:header>
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Dashboard') }}
            </h2>
            <Link confirm="Apakah yakin keluar?" confirm-button="Ya!" cancel-button="Tidak" href="{{ route('logout') }}"
                method="post">
            Keluar
            </Link>
        </div>
        </x-slot>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 ">
                @if (auth()->user()->students->count() != 0)
                    <div class="grid grid-cols-2 gap-2 mb-4 sm:grid-cols-4 sm:gap-3">
                        {{-- <x-card.summary />
                        <x-card.summary />
                        <x-card.summary />
                        <x-card.summary /> --}}
                    </div>
                    <x-splade-rehydrate on="done-admission">
                        <x-dashboard.santri-baru :data="$x" />
                    </x-splade-rehydrate>
                @else
                    <div class="p-5 overflow-hidden shadow-xl bg-white/30 sm:rounded-lg backdrop-blur-md">
                        <x-welcome />
                    </div>
                @endif
            </div>
        </div>
</x-app-layout>
