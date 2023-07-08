<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Format Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <p class="w-full bg-white/50 p-3 mb-3">
                <strong>Tag tersedia :</strong>
                #username, #nama_ortu, #santri.
            </p>
            <p class="w-full bg-white/50 p-3 mb-3"><strong>Format tersedia :</strong>
                #enter</p>

            <x-splade-form :default="$formatMessage" :action="route('format-message.update', $formatMessage->id)" class="flex flex-col gap-4" method="put"
                confirm="Really ..." confirm-button="Yes, take me there!" cancel-button="No, keep me save!">
                <div class="flex gap-4">
                    <div class="w-full flex flex-col gap-4">
                        <x-splade-textarea name="message" autosize />
                    </div>
                </div>
                <button type="submit"
                    class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                    Update
                </button>
            </x-splade-form>
        </div>
    </div>
</x-app-layout>
