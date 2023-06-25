@seoTitle(__('Dashboard'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                @if (auth()->user()->students->count() != 0)
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 mb-4">
                        {{-- <x-card.summary />
                        <x-card.summary />
                        <x-card.summary />
                        <x-card.summary /> --}}
                    </div>
                    <x-splade-rehydrate on="done-admission">
                        <x-dashboard.santri-baru :data="$x" />
                    </x-splade-rehydrate>
                @else
                    <div class="bg-white/30 overflow-hidden shadow-xl sm:rounded-lg p-5 backdrop-blur-md">
                        <x-welcome />
                    </div>
                @endif
            </div>
        </div>
</x-app-layout>
