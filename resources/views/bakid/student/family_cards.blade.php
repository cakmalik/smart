@seoTitle(__('bakid.t.family_members'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl">
            {{ __('bakid.t.family_cards') }}
        </h2>
    </x-slot:header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-col grid-cols-2">
                {{-- <img src="{{ asset('storage/k_mahram/') }}" alt=""> --}}
            </div>
        </div>
    </div>
</x-app-layout>
