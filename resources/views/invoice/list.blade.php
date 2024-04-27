<x-splade-modal max-width="xl">
    <div class="z-50 min-h-screen">
        <x-splade-toggle data="isHistory">
            <div class="flex justify-between mt-6 gap-1 ">
                <button class="w-full py-2 border border-slate-400 rounded-l-md uppercase"
                    :class="{ 'bg-green-500 text-white': !isHistory }" @click.prevent="setToggle('isHistory',false)">
                    Tagihan Baru</button>
                <button class="w-full py-2 border border-slate-400 rounded-r-md uppercase"
                    :class="{ 'bg-green-500 text-white': isHistory }"
                    @click.prevent="setToggle('isHistory',true)">Riwayat</button>
            </div>
            <div v-show="isHistory">
                <x-table v-show="isHistory" class="shadow-none">
                    <x-slot name="header">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Judul
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nominal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rincian
                            </th>
                        </tr>
                    </x-slot>
                    @forelse ($histories as $i)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $i->description }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format($i->amount) }}
                            </td>
                            @php
                                if ($i->file) {
                                    if ($i->file?->status != 'waiting') {
                                        $status = $i->file?->status;
                                    } else {
                                        $status = $i->status;
                                    }
                                } else {
                                    $status = $i->status;
                                }
                            @endphp
                            @switch($status)
                                @case('reject')
                                    <td class="uppercase px-6 py-4 bg-red-300 text-red-800 font-semibold">
                                        {{ __($status) }}
                                    </td>
                                @break

                                @default
                                    <td class="uppercase px-6 py-4 bg-gray-200 font-semibold">
                                        {{ __($status) }}
                                    </td>
                            @endswitch
                            <td class="px-6 py-4">
                                <Link class="flex items-center justify-center cursor-pointer"
                                    href="{{ route('invoice.show', $i->invoice_number) }}">
                                <i class="ph-fill ph-magnifying-glass-plus"></i>
                                <span>{{ $i->invoice_number }}</span>
                                </Link>
                            </td>
                        </tr>
                        @empty
                            <tr class="text-center h-40">
                                <td colspan="4">
                                    <div class="flex flex-col justify-center items-center p-4 gap-1">
                                        <lottie-player
                                            src="https://lottie.host/e1929754-8ae8-40ae-af73-de3d132e5fb6/ZVkbeMfTvv.json"
                                            background="transparent" speed="1" style="width: 300px; height: 300px;"
                                            loop autoplay></lottie-player>
                                        <span class="text-lg">Belum ada riwayat pembayaran</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </x-table>
                </div>

                <div class="mt-3 p-1 w-full" v-show="!isHistory">
                    @forelse ($invoices as $i)
                        <Link href="{{ route('invoice.show', $i->invoice_number) }}">
                        <div class="bg-white w-full border  rounded-xl space-y-1 text-center overflow-hidden">
                            <div class="px-3 font-semibold text-lg">
                                {{ $i->description }}
                            </div>
                            <div class="px-3 ">
                                <span
                                    class="bg-yellow-100 text-yellow-800 font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                    {{ __($i->status) }}</span>
                            </div>
                            <div class="px-3 font-bold text-lg">
                                Rp{{ number_format($i->amount) }}
                            </div>
                            <div class="px-3 bg-gray-400 text-white py-2">
                                <Link class="flex items-center justify-center cursor-pointer"
                                    href="{{ route('invoice.show', $i->invoice_number) }}">
                                {{-- <i class="ph-fill ph-magnifying-glass-plus"></i> --}}
                                <span>
                                    Detail
                                </span>
                                </Link>
                            </div>
                        </div>
                        </Link>
                    @empty 
                        {{-- <tr class="text-center h-40 w-full bg-emerald-300">
                    <td colspan="4"> --}}
                        <div class="flex flex-col justify-center items-center p-4 gap-1">
                            <lottie-player src="https://lottie.host/e1929754-8ae8-40ae-af73-de3d132e5fb6/ZVkbeMfTvv.json"
                                background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                autoplay></lottie-player>
                            <span class="text-lg">Belum tagihan terbaru</span>
                        </div>
                        {{-- </td>
                </tr> --}}
                    @endforelse
                </div>
            </x-splade-toggle>
        </div>
    </x-splade-modal>
