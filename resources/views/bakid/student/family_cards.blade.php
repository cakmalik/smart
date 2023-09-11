@seoTitle(__('family_members'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Family Cards') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-col grid-cols-2">
                {{-- <img src="{{ asset('storage/k_mahram/') }}" alt=""> --}}
            </div>
        </div>
    </div>
</x-app-layout>
