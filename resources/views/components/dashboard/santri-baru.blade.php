    <div class="mx-3 gap-5 sm:gap-3 sm:mx-auto max-w-5xl p-0 lg:p-8 ">
        @if ($data['invoices_psb']->isNotEmpty())
            <h1 class="mt-0 text-2xl font-medium text-gray-900 text-center bg-white/50 rounded-lg p-3 backdrop-blur-md">
                Selangkah lagi

            </h1>
            <div class=" grid grid-col md:grid-cols-2 mt-4 text-center gap-3">
                <Link @if ($data['students']->isEmpty()) href="#"  @else href="#modalLembaga" @endif
                    class="relative p-3 py-5 w-full @if ($data['students']->isEmpty()) bg-white/50 cursor-default  @else bg-green-400 @endif rounded-xl">
                @if ($data['students']->isEmpty())
                    <div class="absolute right-2 top-2 p-1 rounded-full  bg-green-500"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ffffff"
                            viewBox="0 0 256 256">
                            <path
                                d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z">
                            </path>
                        </svg>
                    </div>
                @endif
                <svg class="inline-flex justify-center" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M240,208H224V96a16,16,0,0,0-16-16H144V32a16,16,0,0,0-24.88-13.32L39.12,72A16,16,0,0,0,32,85.34V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM208,96V208H144V96ZM48,85.34,128,32V208H48ZM112,112v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm-32,0v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm0,56v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Zm32,0v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Z">
                    </path>
                </svg>
                <h3 class="text-xl">{{ __('Choose Educations') }}</h3>
                </Link>

                <Link @if ($data['studentsWithoutRooms']->isEmpty()) href="#"  @else href="#modalAsrama" @endif
                    class="relative p-3 py-5 w-full @if ($data['studentsWithoutRooms']->isEmpty()) bg-white/50 cursor-default  @else bg-green-400 @endif rounded-xl">

                @if ($data['studentsWithoutRooms']->isEmpty())
                    <div class="absolute right-2 top-2 p-1 rounded-full  bg-green-500"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ffffff"
                            viewBox="0 0 256 256">
                            <path
                                d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z">
                            </path>
                        </svg>
                    </div>
                @endif
                <svg class="inline-flex justify-center" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M240,208H224V96a16,16,0,0,0-16-16H144V32a16,16,0,0,0-24.88-13.32L39.12,72A16,16,0,0,0,32,85.34V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM208,96V208H144V96ZM48,85.34,128,32V208H48ZM112,112v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm-32,0v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm0,56v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Zm32,0v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Z">
                    </path>
                </svg>
                <h3 class="text-xl">{{ __('Choose Rooms') }}</h3>
                </Link>

                @if (auth()->user()->doc_kk == null)
                <Link @if (auth()->user()->doc_kk != null) href="#"  @else href="#modalUploadKK" @endif
                    class="relative p-3 py-5 w-full @if (auth()->user()->doc_kk != null) bg-white/50 cursor-default  @else bg-green-400 @endif rounded-xl">
                <svg class="inline-flex justify-center" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M96,104a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H104A8,8,0,0,1,96,104Zm8,40h64a8,8,0,0,0,0-16H104a8,8,0,0,0,0,16Zm128,48a32,32,0,0,1-32,32H88a32,32,0,0,1-32-32V64a16,16,0,0,0-32,0c0,5.74,4.83,9.62,4.88,9.66h0A8,8,0,0,1,24,88a7.89,7.89,0,0,1-4.79-1.61h0C18.05,85.54,8,77.61,8,64A32,32,0,0,1,40,32H176a32,32,0,0,1,32,32V168h8a8,8,0,0,1,4.8,1.6C222,170.46,232,178.39,232,192ZM96.26,173.48A8.07,8.07,0,0,1,104,168h88V64a16,16,0,0,0-16-16H67.69A31.71,31.71,0,0,1,72,64V192a16,16,0,0,0,32,0c0-5.74-4.83-9.62-4.88-9.66A7.82,7.82,0,0,1,96.26,173.48ZM216,192a12.58,12.58,0,0,0-3.23-8h-94a26.92,26.92,0,0,1,1.21,8,31.82,31.82,0,0,1-4.29,16H200A16,16,0,0,0,216,192Z">
                    </path>
                </svg>
                <h3 class="text-xl">{{ __('Upload Kartu Keluarga') }}</h3>
                </Link>
                @endif

                {{-- TODO:kerjakan next --}}
                @if ($data['invoices_psb']->isNotEmpty())
                    @php
                        $invoice_number = $data['invoices_psb']->first()->invoice_number;
                        $is_selected = !!$data['invoices_psb']->first()->payment_method_id;
                    @endphp
                    @if (!$is_selected)
                        <Link class="p-3 py-5 w-full bg-green-400 rounded-xl"
                            href="{{ route('payment.choose-method', $invoice_number) }}">
                        <svg class="inline-flex justify-center" xmlns="http://www.w3.org/2000/svg" width="40"
                            height="40" fill="#000000" viewBox="0 0 256 256">
                            <path
                                d="M224,48H32A16,16,0,0,0,16,64V192a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V64A16,16,0,0,0,224,48Zm0,16V88H32V64Zm0,128H32V104H224v88Zm-16-24a8,8,0,0,1-8,8H168a8,8,0,0,1,0-16h32A8,8,0,0,1,208,168Zm-64,0a8,8,0,0,1-8,8H120a8,8,0,0,1,0-16h16A8,8,0,0,1,144,168Z">
                            </path>
                        </svg>
                        <h3 class="text-xl">{{ __('Complete Payment') }}</h3>
                        </Link>
                    @else
                        <Link class="col-span-2 p-3 py-5 w-full bg-yellow-200 rounded-xl"
                            href="{{ route('payment.choose-method', $invoice_number) }}">
                        <svg class="inline-flex justify-center" xmlns="http://www.w3.org/2000/svg" width="40"
                            height="40" fill="#000000" viewBox="0 0 256 256">
                            <path
                                d="M224,48H32A16,16,0,0,0,16,64V192a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V64A16,16,0,0,0,224,48Zm0,16V88H32V64Zm0,128H32V104H224v88Zm-16-24a8,8,0,0,1-8,8H168a8,8,0,0,1,0-16h32A8,8,0,0,1,208,168Zm-64,0a8,8,0,0,1-8,8H120a8,8,0,0,1,0-16h16A8,8,0,0,1,144,168Z">
                            </path>
                        </svg>
                        <h3 class="text-xl">Menunggu Pembayaran...</h3>
                        <p>Klik untuk melihat cara pembayaran</p>
                        </Link>
                    @endif
                @endif
            </div>

            <x-splade-modal name="modalLembaga">
                <x-splade-form :action="route('student.complete-education')" stay background reset-on-success
                    @success="$splade.emit('done-admission')">
                    <x-splade-select class="mb-3 mt-5" :options="$data['students']" option-label="name" option-value="id"
                        name="student_id" placeholder="{{ __('Pilih Putra/i') }}" choices="{ searchEnabled: false }" />
                    <x-splade-select class="mb-3" :options="$data['formal']" option-label="name" option-value="id"
                        name="formal_id" placeholder="{{ __('Formal') }}" />
                    <x-splade-select class="mb-3" remote-url="`/api/formal_classes/${form.formal_id}`"
                        option-label="class_name" option-value="id" name="formal_class_id"
                        placeholder="{{ __('Pilih Kelas') }}" />

                    <x-splade-select class="mb-3" :options="$data['informal']" option-label="name" option-value="id"
                        name="informal_id" placeholder="{{ __('Informal') }}" />
                    <x-splade-select class="mb-3" remote-url="`/api/informal_classes/${form.informal_id}`"
                        option-label="class_name" option-value="id" name="informal_class_id"
                        placeholder="{{ __('Pilih Kelas') }}" />

                    <div class="flex justify-end">
                        <x-splade-submit>
                            Kirim Pengajuan
                        </x-splade-submit>
                    </div>
                    {{-- <Counter :formal="@js($data['formal'])" /> --}}
                </x-splade-form>
            </x-splade-modal>


            <x-splade-modal name="modalAsrama">
                <x-splade-form :action="route('student.complete-room')" stay background reset-on-success
                    @success="$splade.emit('done-admission')">
                    <x-splade-select class="mb-3 mt-5" :options="$data['studentsWithoutRooms']" option-label="name" option-value="id"
                        name="student_id" placeholder="{{ __('Pilih Putra/i') }}" choices="{ searchEnabled: false }" />

                    <x-splade-select class="mb-3" remote-url="`/api/dormitories/by-student-gender/${form.student_id}`"
                        option-label="name" option-value="id" name="dormitory_id"
                        placeholder="{{ __('Pilih Daerah') }}" />

                    <x-splade-select class="mb-3" remote-url="`/api/rooms/by-dormitory/${form.dormitory_id}`"
                        option-label="name" option-value="id" name="room_id"
                        placeholder="{{ __('Pilih Asrama') }}" />


                    <div class="flex justify-end">
                        <x-splade-submit>
                            Kirim Pengajuan
                        </x-splade-submit>
                    </div>
                    {{-- <Counter :formal="@js($data['formal'])" /> --}}
                </x-splade-form>
            </x-splade-modal>

            <x-splade-modal name="modalUploadKK">
                <x-splade-form method="post" :action="route('user.upload-kk', auth()->user()->id)" stay background reset-on-success
                    @success="$splade.emit('done-admission')">
                    <div>
                        <x-splade-file v-model="form.doc_kk" :show-filename="false" label="Foto Kartu Keluarga" filepond
                            max-size="3MB" class="mt-2" />
                        <img class="w-full p-5" name="doc_kk" :src="form.$fileAsUrl('doc_kk')" class="mt-2" />

                        <x-splade-submit v-if="form.doc_kk">
                            Simpan Dokumen
                        </x-splade-submit>
                    </div>
                </x-splade-form>
            </x-splade-modal>
        @else

        <x-bakid.dashboard.welcome-text/>
        <x-add.ayat />
        @endif
    </div>
