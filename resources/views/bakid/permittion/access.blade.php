<div>
    @php $inOuts = $data->get(); @endphp
    <div class="w-full min-h-screen sm:p-2 md:p-4 lg:p-10 sm:flex gap-2 lg:text-xl">
        <x-splade-rehydrate on="updated-izin">
            <div class="sm:w-1/3 max-h-screen rounded-xl flex flex-col gap-4">
                {{-- image wrapper --}}
                <div class="w-full h-1/2 sm:max-h-60 lg:max-h-80 bg-white rounded-xl overflow-hidden border">
                    <img class="w-full h-full object-cover" src="{{ $data->first()?->student->student_image }}"
                        onerror="this.onerror=null; this.src='{{ asset('bakid/default_image.jpg') }}'" alt="">
                </div>
                <div class="grow mt-4 text-gray-600 lg:text-2xl gap-2">
                    <div class="flex justify-center capitalize font-semibold text-center border-b pb-3">
                        <span>{{ $data->first()?->student->name }}</span>
                    </div>
                    <div class="flex justify-between text-right border-b pb-3">
                        <span class="font-semibold">Asrama</span>
                        <span>{{ $data->first()?->student->getAsramaName() }}</span>
                    </div>
                    <div class="flex justify-between text-right border-b pb-3">
                        <span class="font-semibold">Jarak</span>
                        <span>{{ $data->first()?->type->name . ' (' . $data->first()?->type->duration . ')' }}</span>
                    </div>
                    <div class="flex justify-between text-right border-b pb-3">
                        <span class="font-semibold">Keluar</span>
                        <span>{{ \Carbon\Carbon::parse($data->first()?->out_time)->format('H:i') }}</span>
                    </div>
                    <div class="flex justify-between text-right border-b pb-3">
                        <span class="font-semibold">Masuk</span>
                        @php
                            $in = $data->first()?->in_time;
                            $is_late = $data->first()?->is_late ? 'Terlambat' : 'Tepat Waktu';
                            if (!$in) {
                                $in_text = '__ __';
                                $is_late = '__ __';
                            } else {
                                $in_text = \Carbon\Carbon::parse($data->first()?->in_time)->format('H:i');
                            }
                        @endphp
                        <span>{{ $in_text }}</span>
                    </div>
                    <div class="flex justify-between text-right border-b pb-3">
                        <span class="font-semibold">Status</span>
                        <span class="@if ($data->first()?->is_late) bg-red-200 @endif"> {{ $is_late }}</span>
                    </div>
                </div>
            </div>
        </x-splade-rehydrate>
        <div class="w-full rounded-xl sm:px-4 md:px-6 lg:px-12 flex flex-col">
            <x-splade-form method="post" action="{{ route('permittion.access.post') }}" stay preserve-scroll background
                @success="$splade.emit('updated-izin')" reset-on-success>
                <div class="flex w-full h-14 ">
                    <input type="text" placeholder="Catatan" class="w-[30%] lg:text-xl" autofocus name="reason"
                        v-model="form.reason">
                    <select id="" class="capitalize w-[30%] lg:text-xl" name="type" v-model="form.type">
                        <option value="" selected disabled>Tujuan</option>
                        @foreach ($type as $i)
                            <option class="capitalize" value="{{ $i->id }}">
                                {{ $i->name . ' (' . $i->duration . ')' }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" class="w-[30%] lg:text-xl" placeholder="Scan atau masukkan NIS"
                        v-model="form.nis" name="nis">
                    <button class="flex items-center justify-center grow border bg-wa-teal1 text-white" type="submit">
                        <i class="ph ph-arrow-right"></i>
                    </button>
                </div>
            </x-splade-form>
            <div class="flex flex-col md:my-6">
                <div class="py-4 bg-wa-teal1">
                    <h3 class="text-xl font-semibold text-center uppercase text-white ">Riwayat Perizinan</h3>
                </div>
                <div class="relative overflow-x-auto border overflow-y-scroll bg-red-400 max-h-[60vh] overflow-scroll">
                    <x-splade-rehydrate on="updated-izin">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 lg:text-xl">
                            <thead
                                class="text-xl text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Asrama') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Category') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Out') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Is Late') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inOuts as $i)
                                    <tr
                                        class=" border-b dark:bg-gray-800 dark:border-gray-700 @if ($i->is_late && $i->in_time != null) bg-red-200 @else bg-white @endif">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $i->student->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $i->student->getAsramaName() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $i->type->name . ' (' . $i->type->duration . ')' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ \Carbon\Carbon::parse($i->out_time)->translatedFormat('H:i') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($i->in_time == null)
                                                <span>_</span>
                                            @else
                                                {{ $i->is_late ? 'Y' : 'N' }}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </x-splade-rehydrate>

                </div>
            </div>
        </div>
    </div>
</div>
