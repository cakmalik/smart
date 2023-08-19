@seoTitle(__('Choose Payment Method'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl">
            {{ __('Invoice Details') }}
        </h2>
        </x-slot>
        <x-splade-toggle data="isUpload">
            <div class="max-w-7xl py-12 mx-auto sm:px-6 lg:px-8">

                <x-button.back />
                {{-- <div class="flex mb-3 ">
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

                    <button v-else @click.prevent="toggle('isUpload')"
                        class="py-1 px-3 bg-white rounded-full mb-3 flex items-center justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
                            </path>
                        </svg>
                        Kembali
                    </button>
                </div> --}}

                {{-- start Invoice --}}
                <div class="w-full grid grid-col sm:grid-cols-3 gap-4" v-if="!isUpload">

                    <div class="w-full col-span-2 bg-white sm:rounded-lg ps-4 pe-6 pt-4 sm:p-6">
                        <div class="grid grid-col sm:flex justify-between gap-3">
                            <img src="{{ asset('bakid/MUBAKID-with-label.png') }}"
                                class="w-3/4 sm:w-[300px] order-last sm:order-first">
                            @if ($invoice->file?->id)
                                @switch($invoice->file->status)
                                    @case('approved')
                                        <h3
                                            class="uppercase px-3 rounded-lg border sm:h-7 text-end border-green-500 bg-green-200 font-semibold">
                                            dibayar
                                        </h3>
                                    @break

                                    @case('waiting')
                                        <h3
                                            class="uppercase px-3 rounded-lg border sm:h-7 text-end border-yellow-500 bg-yellow-200 font-semibold">
                                            Menunggu persetujuan
                                        </h3>
                                    @break

                                    @default
                                        <h3
                                            class="uppercase px-3 rounded-lg border sm:h-7 text-end border-red-500 bg-red-200 font-semibold">
                                            ditolak
                                        </h3>
                                @endswitch
                            @else
                                <h3
                                    class="uppercase px-3 rounded-lg border sm:h-7 text-endborder-yellow-500 bg-yellow-200 font-semibold">
                                    {{ __($invoice->status) }}
                                </h3>
                            @endif

                        </div>
                        <div class="relative mt-3 bg-yellow-300 w-full h-6 overflow-scroll">
                            <div class="absolute bg-white px-2 right-8 my-auto  flex items-center">
                                <h3 class="font-semibold text-lg ">{{ __('INVOICE') }}</h3>
                            </div>
                        </div>
                        <div id="content" class="w-full mt-3 p-3 overflow-scroll">
                            <div class="flex items-start  sm:justify-between">
                                <div class="hidden sm:block"> </div>
                                <div>
                                    <p> Invoice# : {{ $invoice->invoice_number }}</p>

                                    @if ($invoice->status == 'paid')
                                        <p> Date : {{ Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}
                                        </p>
                                    @else
                                        <div class="">
                                            <div><span> Berakhir pada </span>:
                                                <span
                                                    class="font-bold">{{ Carbon\Carbon::parse($invoice->updated_at)->addHours(24)->translatedFormat('D, d M Y') }}</span>
                                            </div>
                                            <div><span> Jam </span>:
                                                <span
                                                    class="font-bold">{{ Carbon\Carbon::parse($invoice->updated_at)->addHours(24)->format('H:i') }}</span>
                                            </div>
                                        </div>
                                    @endif
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
                    @if ($invoice->status == 'waiting' && $invoice->file?->id)
                        <div class="w-screen sm:w-full bg-white sm:rounded-lg p-4 sm:p-6 overflow-auto">
                            <div class="w-full mb-4">
                                <span
                                    class="text-lg font-semibold border-b border-gray-300">{{ __('Proof of payment') }}:</span>
                            </div>
                            <div class="mb-2 sm:w-full">
                                <img src="{{ asset('storage/proof/' . $invoice->file->file_name) }}" alt="">
                            </div>
                            <table class="text-left">
                                <tr>
                                    <th>
                                        <span class="">Kode Tagihan</span>
                                    </th>
                                    <td>
                                        <span class="">: {{ $invoice->invoice_number }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="">Bank pengirim</span>
                                    </th>
                                    <td>
                                        <span class="">: {{ $invoice->file->from_bank }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="">Nama pengirim</span>
                                    </th>
                                    <td>
                                        <span class="">: {{ $invoice->file->from_account }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="">Bank tujuan</span>
                                    </th>
                                    <td>
                                        <span class="">: {{ $invoice->file->to_bank }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="">Nominal</span>
                                    </th>
                                    <td>
                                        <span class="">: Rp
                                            {{ number_format($invoice->file->amount) }}</span>
                                    </td>
                                </tr>
                            </table>

                            <div class="w-full my-4">
                                <span
                                    class="text-lg font-semibold border-b border-gray-300">{{ __('Tindakan') }}:</span>
                            </div>
                            {{-- @can('approval payment') --}}
                            <x-splade-form :action="route('invoice.confirm')" methood="POST" :default="$invoice">
                                <x-splade-data :default="['accepted' => true]">
                                    <div class="w-full flex justify-start items-center">
                                        <button @click.prevent="data.accepted=true"
                                            class=" flex items-center justify-center gap-1 py-2 px-4 bg-green-50 text-green-800 hover:bg-green-200"
                                            :class="{ 'bg-green-600 text-white hover:bg-green-700': data.accepted }">
                                            <i class="ph-fill ph-check-circle"></i>
                                            <span>{{ __('Approve') }}</span>
                                        </button>
                                        <button @click.prevent="data.accepted=false"
                                            class=" flex items-center justify-center gap-1 py-2 px-4 bg-red-50 text-red-800 hover:bg-red-200 "
                                            :class="{ 'bg-red-600 text-white hover:bg-red-700': !data.accepted }">
                                            <i class="ph-fill ph-x-circle"></i>
                                            <span>{{ __('Reject') }}</span>
                                        </button>
                                    </div>
                                    <x-splade-input type="hidden" v-model="invoice_number" name="invoice_number" />
                                    <div v-if="!data.accepted">
                                        <x-splade-input :label="__('Reason')" name="desc" class="mb-3" />
                                        <x-splade-submit label="Konfirmasi" class="rounded-lg" />
                                    </div>
                                    <div class="mt-3" v-else>
                                        <x-button.base :link="route('invoice.approve', $invoice->invoice_number)" variant="md" color="success">
                                            Konfirmasi
                                        </x-button.base>
                                    </div>
                                </x-splade-data>
                            </x-splade-form>
                            {{-- @endcan --}}
                        </div>
                    @else
                        <div class="w-screen sm:w-full bg-white sm:rounded-lg p-4 sm:p-6 overflow-auto">
                            <div class="w-full mb-4">
                                <span
                                    class="text-lg font-semibold border-b border-gray-300">{{ __('Payment Instructions') }}
                                    ({{ $invoice->method->name }}):</span>
                            </div>
                            <div class="p-3 sm:w-full">
                                <p>
                                <ul class="list-decimal">
                                    @isset($pi->steps)
                                        @foreach (json_decode($pi->steps) as $step)
                                            <li>{{ $step }}</li>
                                        @endforeach
                                    @endisset
                                </ul>
                                </p>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- end Invoice --}}

                <div class="flex justify-center w-full" v-else>
                    <div class="flex justify-center bg-white/30 sm:rounded-lg p-3 sm:w-1/2">
                        <x-splade-form action="{{ route('invoice.upload-proof') }}" :default="$invoice">
                            <x-splade-input class="mt-2" name="invoice_number" type="text" label="Kode Tagihan" />

                            <x-splade-input class="mt-2" name="from_bank" type="text"
                                label="Bank/e-wallet pengirim" />
                            <x-splade-input class="mt-2" name="from_account" type="text" label="Nama pengirim" />
                            <x-splade-input class="mt-2" name="to_bank" type="text" label="Bank tujuan" />
                            <x-splade-input class="mt-2" name="amount" type="text" label="Nominal" />
                            <x-splade-input class="mt-2" name="reference" type="text" label="Kode referensi" />
                            <x-splade-input class="mt-2" name="desc" type="text" label="Keterangan" />

                            <x-splade-file name="filename" :show-filename="false"
                                label="Bukti transfer (Wajib dilampirkan)" filepond
                                accept="image/jpg, image/png, image/jpeg" max-size="2MB" class="mt-2" />
                            <img class="w-full p-5" v-if="form.filename" :src="form.$fileAsUrl('filename')"
                                class="mt-2" />
                            {{-- 
                            @error('filename')
                                <p> {{ $message }}</p>
                            @enderror

                            @if ($errors->any())
                                <div class="bg-blue-700">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                            <x-splade-submit class="mt-3">Kirim</x-splade-submit>
                        </x-splade-form>
                    </div>
                </div>
                @hasrole('santri')
                    @if (!$invoice->file?->id)
                        <div class="flex justify-around sm:justify-end items-center sm:mt-4 sm:gap-4 sm:mx-3"
                            v-if="!isUpload">
                            <Link href="{{ route('payment.choose-method', $invoice->invoice_number) }}"
                                class="flex items-center gap-2 px-5 py-3 sm:py-4 ring-2 bg-white ring-green-700 sm:rounded-full hover:bg-slate-200 text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="hidden sm:block" width="20"
                                height="20" fill="#000000" viewBox="0 0 256 256">
                                <path
                                    d="M197.67,186.37a8,8,0,0,1,0,11.29C196.58,198.73,170.82,224,128,224c-37.39,0-64.53-22.4-80-39.85V208a8,8,0,0,1-16,0V160a8,8,0,0,1,8-8H88a8,8,0,0,1,0,16H55.44C67.76,183.35,93,208,128,208c36,0,58.14-21.46,58.36-21.68A8,8,0,0,1,197.67,186.37ZM216,40a8,8,0,0,0-8,8V71.85C192.53,54.4,165.39,32,128,32,85.18,32,59.42,57.27,58.34,58.34a8,8,0,0,0,11.3,11.34C69.86,69.46,92,48,128,48c35,0,60.24,24.65,72.56,40H168a8,8,0,0,0,0,16h48a8,8,0,0,0,8-8V48A8,8,0,0,0,216,40Z">
                                </path>
                            </svg>
                            <span class="text-center"> Ganti Metode Pembayaran</span>
                            </Link>
                            <button @click.prevent="toggle('isUpload')"
                                class="flex items-center gap-2 px-5 py-3 sm:py-4 bg-yellow-300 ring-2 ring-green-700 sm:rounded-full hover:bg-slate-200 text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" class="hidden sm:block" width="20"
                                    height="20" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M248,128a87.34,87.34,0,0,1-17.6,52.81,8,8,0,1,1-12.8-9.62A71.34,71.34,0,0,0,232,128a72,72,0,0,0-144,0,8,8,0,0,1-16,0,88,88,0,0,1,3.29-23.88C74.2,104,73.1,104,72,104a48,48,0,0,0,0,96H96a8,8,0,0,1,0,16H72A64,64,0,1,1,81.29,88.68,88,88,0,0,1,248,128Zm-90.34-5.66a8,8,0,0,0-11.32,0l-32,32a8,8,0,0,0,11.32,11.32L144,147.31V208a8,8,0,0,0,16,0V147.31l18.34,18.35a8,8,0,0,0,11.32-11.32Z">
                                    </path>
                                </svg>
                                <span class="text-center"> Upload Bukti</span>

                            </button>
                        </div>
                    @endif
                @endhasrole

        </x-splade-toggle>
</x-app-layout>
