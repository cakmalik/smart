<x-splade-modal max-width="xl">
    <x-splade-toggle data="isHistory">
        <div class="flex justify-between mt-6 gap-1">
            <button class="w-full py-2 border border-slate-400 rounded-l-md"
                :class="{ 'bg-green-500 text-white': !isHistory }" @click.prevent="toggle('isHistory')">List
                tagihan</button>
            <button class="w-full py-2 border border-slate-400 rounded-r-md"
                :class="{ 'bg-green-500 text-white': isHistory }" @click.prevent="toggle('isHistory')">Riwayat</button>
        </div>
        <div v-show="isHistory">
            <x-table v-show="isHistory">
                <x-slot name="header">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Judul
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nominal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rincian
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </x-slot>
                @forelse ($histories as $i)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <Link class="flex items-center justify-center cursor-pointer"
                                href="{{ route('invoice.show', $i->invoice_number) }}">
                            <i class="ph-fill ph-magnifying-glass-plus"></i>
                            <span>{{ $i->invoice_number }}</span>
                            </Link>
                        </td>

                        <td class="px-6 py-4">
                            {{ $i->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $i->amount }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $i->status }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"> Belum ada riwayat pembayaran</td>
                    </tr>
                @endforelse
            </x-table>
        </div>

        <div class="" v-show="!isHistory">
            <x-table>
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
                @forelse ($invoices as $i)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <Link class="flex items-center justify-center cursor-pointer"
                                href="{{ route('invoice.show', $i->invoice_number) }}">
                            <i class="ph-fill ph-magnifying-glass-plus"></i>
                            <span>{{ $i->invoice_number }}</span>
                            </Link>
                        </td>

                        <td class="px-6 py-4">
                            {{ $i->description }}
                        </td>
                        <td class="flex items-center px-6 py-4 space-x-3">
                            {{ $i->amount }}
                        </td>
                        <td class="flex items-center px-6 py-4 space-x-3">
                            {{ $i->status }}
                        </td>
                    </tr>
                @empty
                    <tr class="text-center h-40">
                        <td colspan="4">
                            <div class="flex flex-col justify-center items-center p-4 gap-1">
                                <lottie-player
                                    src="https://lottie.host/e1929754-8ae8-40ae-af73-de3d132e5fb6/ZVkbeMfTvv.json"
                                    background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                    autoplay></lottie-player>
                                <span class="text-lg">Belum tagihan terbaru</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </div>
    </x-splade-toggle>
</x-splade-modal>
