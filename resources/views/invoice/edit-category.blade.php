<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Invoice Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-bakid.card>
                <x-button.back route="{{ $route_back }}" />
                <x-splade-form :default="$category" :action="route('invoice.category.update', $category->id)" class="flex flex-col gap-4 p-6" method="put" stay 
                    preserve-scroll @success="$splade.emit('invoice-category-updated')">
                    <div class="flex gap-4">
                        <div class="w-full flex flex-col gap-4">
                            <x-splade-input name="name" :label="__('Judul/Nama')" placeholder="namamu" />
                            <x-splade-input type="number" name="amount" :label="__('Besar Tagihan')" placeholder="100000" />
                            <x-splade-select name="is_discount_for_siblings" label="Diskon Bersaudara">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </x-splade-select>
                        </div>
                    </div>

                    <x-splade-rehydrate on="invoice-category-updated">
                        @if ($category->is_discount_for_siblings)
                            <div class=" border border-slate-500 rounded-md p-2 my-3">
                                <h3 class="font-semibold text-xl mb-2">{{ __('Discount Category') }}</h3>
                                <div class="flex">
                                    <div class="flex w-full">
                                        <table class="table-auto w-full">
                                            <tbody>
                                                @forelse ($category->discounts as $discount)
                                                    <tr class="">
                                                        <td class="border border-white text-center">
                                                            {{ $discount->number_of_child }}</td>
                                                        <td class="border border-white text-center">
                                                            {{ $discount->discount_amount }}</td>
                                                        <td class="border border-white text-center">
                                                            {{ $discount->discount_type == 'percentage' ? '%' : 'Rp' }}</td>
                                                        <td class="border border-white text-center">
                                                            <Link confirm stay preserve-scroll background
                                                                href="{{ route('invoice.discount.remove', $discount->id) }}">
                                                            <i class="ph ph-trash"></i>
                                                            </Link>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    Tidak ditemukan
                                                @endforelse
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </x-splade-rehydrate>
                    
                    <div class="flex justify-between items-center">
                        @if ($category->is_discount_for_siblings)
                            <Link modal href="{{ route('invoice.discount.create', $category->id) }}"
                                class="bg-wa-teal1 p-2 text-white rounded-md text-sm items-center  hover:bg-wa-teal1">
                            <i class="ph ph-plus"></i> {{ __('Add discount ') }}
                            </Link>
                        @endif
                        <x-splade-submit/>
                    </div>
                </x-splade-form>
             </x-bakid.card>
        </div>
    </div>
</x-app-layout>
