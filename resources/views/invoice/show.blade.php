@seoTitle(__('Choose Payment Method'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('Invoice Details') }}
        </h2>
        </x-slot>

        <div class="max-w-7xl py-12 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-col sm:grid-cols-3 gap-3 ">
                <div class="col-span-2 bg-white sm:rounded-lg p-4 sm:p-6">
                    {{-- @include('document.blade.invoice') --}}
                    <div class="">
                        <div class="">
                            <img src="{{ asset('bakid/MUBAKID-with-label.png') }}" class="w-[300px]">
                        </div>
                        {{-- divider --}}
                        <div class="relative mt-3 bg-yellow-300 w-full h-6">
                            <div class="absolute bg-white px-2 right-8 flex items-center">
                                <h3 class="font-semibold text-xl">INVOICE</h3>
                            </div>
                        </div>
                        <div id="content" class="mt-3 p-3">
                            <div class="flex justify-between">
                                <div> </div>
                                <div>
                                    <p> Invoice# : {{ $invoice->invoice_number }}</p>
                                    <p> Date : {{ Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="mt-5">
                                <span class="text-xl border-b border-gray-300">Rincian :</span>
                            </div>
                            <div>

                                <div class="flex justify-between">
                                    <div class="space-x-4">
                                        <span>1</span>
                                        <span>Apa</span>
                                    </div>
                                    <div>
                                        Berapa
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="space-x-4">
                                        <span>1</span>
                                        <span>Apa</span>
                                    </div>
                                    <div>
                                        Berapa
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="space-x-4">
                                        <span>1</span>
                                        <span>Apa</span>
                                    </div>
                                    <div>
                                        Berapa
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div class="space-x-4">
                                    <span class="text-lg font-semibold">Total</span>
                                </div>
                                <span class="text-lg font-semibold">
                                    Berapa
                                </span>

                            </div>



                        </div>
                    </div>
                </div>
                <div class="bg-white sm:rounded-lg p-4 sm:p-6">
                    <div class="mb-4">
                        <span
                            class="text-lg font-semibold border-b border-gray-300">{{ __('Payment Instructions') }}:</span>
                    </div>
                    <x-splade-data :default="\App\Models\PaymentInstruction::first()">
                        <input v-model="data.title" />
                    </x-splade-data>
                </div>
            </div>
        </div>
</x-app-layout>
