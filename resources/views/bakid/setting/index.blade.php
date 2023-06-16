@seoTitle(__('Users'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('Settings') }}
        </h2>
        </x-slot>

        <div class="py-12">

            <x-splade-form action="{{ route('setting.store') }}" submit-on-change="api_key_whatsapp," background
                debounce="2000" stay @success="$splade.emit('setting-updated')">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                        <div class="p-4 py-6 bg-white/50 border-white border-2 w-full rounded-lg">
                            Api Key Whatsapp
                            <x-splade-input name="api_key_whatsapp" />
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                        <div class="p-4 py-6 bg-white w-full rounded-lg">
                            content
                        </div>
                    </div>
                </div>
            </x-splade-form>
        </div>
</x-app-layout>
