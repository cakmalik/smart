<x-app-layout>
    <x-splade-modal>
        <x-splade-lazy>
            <x-slot:placeholder> {{ __('loading') }}... </x-slot:placeholder>
            <x-splade-data :default="$data">
                <div class="flex flex-col gap-3 p-3">
                    <h3 class="text-xl font-semibold"> {{ $data->title }}</h3>
                    <p>{{ $data->body }}</p>
                    <img class="w-full rounded-lg" src="{{ asset('storage/announcement/' . $data->image) }}"
                        alt="">
                </div>
            </x-splade-data>
        </x-splade-lazy>
    </x-splade-modal>
</x-app-layout>
