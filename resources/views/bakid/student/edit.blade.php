<x-app-layout>

    <div class="grid grid-cols-3 my-4 gap-4">
        <div class="flex justify-end">
            <div
                class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <button aria-current="true" type="button"
                    class="w-full px-4 py-2 font-medium text-left text-white bg-blue-700 border-b border-gray-200 rounded-t-lg cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600">
                    Profile
                </button>
                <button type="button"
                    class="w-full px-4 py-2 font-medium text-left border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    Settings
                </button>
                <button type="button"
                    class="w-full px-4 py-2 font-medium text-left border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    Messages
                </button>
                <button disabled type="button"
                    class="w-full px-4 py-2 font-medium text-left bg-gray-100 rounded-b-lg cursor-not-allowed dark:bg-gray-600 dark:text-gray-400">
                    Download
                </button>
            </div>
        </div>
        <div class="col-span-2">
            <div class="bg-white/50 backdrop-filter backdrop-blur-md w-full rounded-l-lg p-4">
                <span
                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gray-600 text-white uppercase mb-4">
                    Judul
                </span>
                <x-splade-form :default="$student">
                    <x-splade-input name="name" label="{{ __('bakid.name') }}/>
                </x-splade-form>
            </div>
        </div>
    </div>


</x-app-layout>
