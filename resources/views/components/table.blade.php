{{-- https://flowbite.com/docs/components/tables/ --}}
{{-- disini component nya. pake yg overflow scrolling --}}
<div class="relative my-3 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            {{ $header }}
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>


{{-- <x-table>
            <x-slot name="header">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Invoice
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
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                </td>
            </tr>
        </x-table> --}}
