<x-app-layout>
    <x-bakid.card>
        <x-splade-lazy>
            <x-slot:placeholder> {{ __('loading') }}... </x-slot:placeholder>
            <h3 class="mt-3 text-xl">{{ $category->name }}</h3>
            <h3 class="text-2xl font-bold mb-3">Rp{{ number_format($category->amount) }}</h3>

            @if ($category->isDiscount())
                <div class="flex border-t border-slate-900 py-6">
                    @foreach ($category->discounts as $cd)
                        <div class="w-full flex justify-between border-b pb-3">
                            <span><span class="font-semibold">{{ $cd->number_of_child }} </span> Anak</span>
                            <span>
                                @if ($cd->discount_type === 'percentage')
                                    Disc: {{ $cd->discount_amount }}%
                                @else
                                    Disc: <span class="font-semibold">{{ number_format($cd->discount_amount) }}</span>
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex flex-col mt-3">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-400">{{ __('Created at') }}</span>
                        <span class="text-sm text-gray-400">{{ $category->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-400">{{ __('Updated at') }}</span>
                        <span class="text-sm text-gray-400">{{ $category->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </x-splade-lazy>
    </x-bakid.card>
</x-app-layout>
