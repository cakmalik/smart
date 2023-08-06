@seoTitle(__('Choose Payment Method'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('Invoice Details') }}
        </h2>
        </x-slot>
        <x-splade-toggle data="isUpload">
            <div class="max-w-7xl py-12 mx-auto sm:px-6 lg:px-8">
                <div class="flex mb-3">
                    <Link v-if="!isUpload" href="{{ route('dashboard') }}"
                        class="py-1 px-3 bg-white rounded-full mb-3 flex items-center justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
                        </path>
                    </svg>
                    Kembali
                    </Link>
               
                    <button v-else  @click.prevent="toggle('isUpload')"
                        class="py-1 px-3 bg-white rounded-full mb-3 flex items-center justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
                            </path>
                        </svg>
                        Kembali
                    </button>
                </div>

                {{-- start Invoice --}}
                <div class="grid grid-col sm:grid-cols-3 gap-3" v-if="!isUpload">
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
                                        <p> Date : {{ Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}
                                        </p>
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
                {{-- end Invoice --}}
                <div class="flex justify-center w-full" v-else>
                    <div class="flex justify-center bg-white/30 sm:rounded-lg p-3 w-1/2">
                        <x-splade-form action="{{ route('invoice.upload-proof') }}" :default="$invoice">
                            <x-splade-input class="mt-2" name="invoice_number" type="text" label="Kode Tagihan" />
                            <x-splade-input class="mt-2" name="payment_method" type="text"
                                label="Nama Bank / E-wallet" />
                            <x-splade-input class="mt-2" name="name" type="text" label="Nama pengirim" />
                            <x-splade-input class="mt-2" name="date" date label="Tanggal pengiriman" />
                            <x-splade-file v-model="form.proof" :show-filename="false" label="Bukti transfer" filepond
                                accept="image/jpg, image/png, image/jpeg" max-size="2MB" class="mt-2" />
                            <img class="w-full p-5" v-if="form.proof" name="proof" :src="form.$fileAsUrl('proof')"
                                class="mt-2" />
                            <x-splade-submit class="mt-3">Kirim</x-splade-submit>
                        </x-splade-form>
                    </div>
                </div>


                <div class="flex justify-between sm:justify-end items-center mt-4 gap-3 mx-3 sm:mx-0" v-if="!isUpload">
                    <Link
                        class="flex items-center gap-2 px-5 py-3 ring-2 bg-white ring-green-700 rounded-full hover:bg-slate-200 text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M197.67,186.37a8,8,0,0,1,0,11.29C196.58,198.73,170.82,224,128,224c-37.39,0-64.53-22.4-80-39.85V208a8,8,0,0,1-16,0V160a8,8,0,0,1,8-8H88a8,8,0,0,1,0,16H55.44C67.76,183.35,93,208,128,208c36,0,58.14-21.46,58.36-21.68A8,8,0,0,1,197.67,186.37ZM216,40a8,8,0,0,0-8,8V71.85C192.53,54.4,165.39,32,128,32,85.18,32,59.42,57.27,58.34,58.34a8,8,0,0,0,11.3,11.34C69.86,69.46,92,48,128,48c35,0,60.24,24.65,72.56,40H168a8,8,0,0,0,0,16h48a8,8,0,0,0,8-8V48A8,8,0,0,0,216,40Z">
                        </path>
                    </svg>
                    Ganti Metode Pembayaran
                    </Link>
                    <button @click.prevent="toggle('isUpload')"
                        class="flex items-center gap-2 px-5 py-3 bg-yellow-300 ring-2 ring-green-700 rounded-full hover:bg-slate-200 text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M248,128a87.34,87.34,0,0,1-17.6,52.81,8,8,0,1,1-12.8-9.62A71.34,71.34,0,0,0,232,128a72,72,0,0,0-144,0,8,8,0,0,1-16,0,88,88,0,0,1,3.29-23.88C74.2,104,73.1,104,72,104a48,48,0,0,0,0,96H96a8,8,0,0,1,0,16H72A64,64,0,1,1,81.29,88.68,88,88,0,0,1,248,128Zm-90.34-5.66a8,8,0,0,0-11.32,0l-32,32a8,8,0,0,0,11.32,11.32L144,147.31V208a8,8,0,0,0,16,0V147.31l18.34,18.35a8,8,0,0,0,11.32-11.32Z">
                            </path>
                        </svg>
                        Upload
                        bukti transfer
                    </button>
                </div>
        </x-splade-toggle>
</x-app-layout>
