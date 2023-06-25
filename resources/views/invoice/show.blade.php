@seoTitle(__('Choose Payment Method'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('Invoice Details') }}
        </h2>
        </x-slot>

        <div class="max-w-7xl py-12 mx-auto sm:px-6 lg:px-8">
            <x-button.back route="dashboard" />
            <div class="grid grid-col sm:grid-cols-3 gap-3">
                <div class="col-span-2 bg-white sm:rounded-lg p-4 sm:p-6">
                    <div class="">
                        <div class="">
                            <img src="{{ asset('bakid/MUBAKID-with-label.png') }}" class="w-[300px]">
                        </div>
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
                                    {{-- <p> Exp : {{ Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') }}</p> --}}
                                </div>
                            </div>
                            <div class="mt-5">
                                <span class="text-xl border-b border-gray-300">Rincian :</span>
                            </div>
                            <div>
                                @foreach ($invoice->invoiceDetails as $i)
                                    <div class="flex justify-between leading-relaxed">
                                        <div class="space-x-4">
                                            <span>{{ $loop->iteration }}</span>
                                            <span>{{ $i->name }}</span>
                                        </div>
                                        <div>
                                            Rp {{ number_format($i->sub_total) }}
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="flex justify-between border-t border-gray-500 mt-3">
                                <div class="space-x-4">
                                    <span class="text-lg font-semibold">Total</span>
                                </div>
                                <span class="text-lg font-semibold">
                                    Rp {{ number_format($invoice->amount) }}
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
                    <div class="p-3 w-full">
                        <p>
                        <ul class="list-decimal">
                            @foreach (json_decode($pi->steps) as $step)
                                <li>{{ $step }}</li>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
