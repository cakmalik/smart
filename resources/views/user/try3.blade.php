<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-5 sm:py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white py-10 px-3 rounded-none sm:rounded-lg">
                <x-splade-form>
                    <div class="flex flex-col md:flex-row gap-5">
                        <div class="w-full md:w-1/2">
                            <x-splade-input name="email" label="Email address" class="mb-3" />
                            <x-splade-input name="email" label="Email address" class="mb-3" />
                            <x-splade-input name="email" label="Email address" class="mb-3" />
                            <x-splade-input name="email" label="Email address" class="mb-3" />
                            <x-splade-input name="email" label="Email address" class="mb-3" />
                        </div>
                        <div class="w-full md:w-1/2">
                            <x-splade-input name="username" :label="__('Username')" class="mb-3" />
                            <x-splade-input name="username" :label="__('Username')" class="mb-3" />
                            <x-splade-input name="username" :label="__('Username')" class="mb-3" />
                            <x-splade-input name="username" :label="__('Username')" class="mb-3" />
                            <x-splade-input name="username" :label="__('Username')" class="mb-3" />
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-splade-submit />
                    </div>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
