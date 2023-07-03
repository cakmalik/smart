<x-splade-modal max-width="xl">
    <x-splade-toggle data="isHistory">
        <div class="flex justify-between mt-6 gap-1">
            <button class="w-full py-2 border border-slate-400 rounded-l-md"
                :class="{ 'bg-green-500 text-white': !isHistory }" @click.prevent="setToggle('isHistory', false)">List
                tagihan</button>
            <button class="w-full py-2 border border-slate-400 rounded-r-md"
                :class="{ 'bg-green-500 text-white': isHistory }"
                @click.prevent="setToggle('isHistory', true)">Riwayat</button>
        </div>
        <x-table v-if="isHistory==true">
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
                </tr>
            </x-slot>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    White
                </td>
                <td class="px-6 py-4">
                    White
                </td>
                <td class="flex items-center px-6 py-4 space-x-3">
                    Rincian
                </td>
            </tr>
        </x-table>
        <x-table v-if="!isHistory">
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
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    White
                </td>
                <td class="px-6 py-4">
                    White
                </td>
                <td class="px-6 py-4">
                    Rincian
                </td>
                <td class="flex items-center px-6 py-4 space-x-3">
                    Rincian
                </td>
            </tr>
        </x-table>
    </x-splade-toggle>
</x-splade-modal>
