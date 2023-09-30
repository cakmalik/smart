@seoTitle(__('Permittion'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Permittion') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex justify-end p-2">
                <Link href="{{ route('permittion.access') }}"
                    class=" flex  items-center  gap-2 p-2 px-4 rounded-lg  text-white bg-wa-teal2 hover:bg-wa-teal1">
                {{ __('Show Permittion Access') }}
                <div class="ph ph-arrow-right"></div>
                </Link>
            </div>
            <x-splade-table :for="$data">
                <x-slot:empty-state>
                    <x-bakid.state.empty />
                </x-slot>
                <x-splade-cell asrama>
                    <span class="text-green-500 p-1 rounded-xl bg-green-100 border">
                        {{ $item->student->getAsramaName() }}</span>
                </x-splade-cell>
                <x-splade-cell duration>
                    {{ $item->type->duration }}
                </x-splade-cell>
                <x-splade-cell is_late>
                    @if ($item->in_time == null)
                        __
                    @else
                        {{ $item->is_late ? 'Y' : 'N' }}
                    @endif
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
