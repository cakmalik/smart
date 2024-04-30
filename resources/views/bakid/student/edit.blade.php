<x-app-layout>

    <x-splade-data remember="menu" :default="['currentIndex' => 0, 'title' => 'Data Pribadi']">
        <x-splade-form :default="$student" :action="route('student.update', $student)" method="put">

            <div class="grid grid-cols-3 my-4 gap-4">
                <div class="flex justify-end">
                    <div
                        class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <div class="flex items-center justify-center py-2 bg-slate-600 text-white mb-1 rounded-t-lg">
                            <span class="text-center">{{ $student->nis }}</span>
                        </div>
                        <button aria-current="true" type="button"
                            class="w-full px-4 py-2 font-medium text-left  border-b border-gray-200 rounded-none cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600"
                            :class="{ 'bg-green-700 text-white': data.currentIndex == 0 }"
                            @click="data.currentIndex=0; data.title = 'Data Pribadi'"> Data
                            Pribadi
                        </button>
                        <button type="button"
                            class="w-full px-4 py-2 font-medium text-left  border-b border-gray-200  cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600"
                            @click="data.currentIndex=1; data.title = 'Keluarga'"
                            :class="{ 'bg-green-700 text-white': data.currentIndex == 1 }">
                            Keluarga
                        </button>
                        <button type="button"
                            class="w-full px-4 py-2 font-medium text-left  border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600"
                            @click="data.currentIndex=2; data.title = 'Tambahan'"
                            :class="{ 'bg-green-700 text-white': data.currentIndex == 2 }">
                            Tambahan
                        </button>

                        <button type="button"
                            class="w-full px-4 py-2 font-medium text-left  border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600"
                            @click="data.currentIndex=3; data.title = 'Update Foto'"
                            :class="{ 'bg-green-700 text-white': data.currentIndex == 3 }">
                            Update Foto
                        </button>

                        <button type="button"
                            class="w-full px-4 py-2 font-medium text-left  border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600"
                            @click="data.currentIndex=5; data.title = 'Asrama'"
                            :class="{ 'bg-green-700 text-white': data.currentIndex == 5 }">
                            Update Asrama
                        </button>

                        <button type="button"
                            class="w-full px-4 py-2 font-medium text-left  border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600"
                            @click="data.currentIndex=4; data.title = 'Dokumen'"
                            :class="{ 'bg-green-700 text-white': data.currentIndex == 4 }">
                            Dokumen
                        </button>



                        {{-- <button type="button"
                        class="w-full px-4 py-2 font-medium text-left  border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600"
                        @click="data.currentIndex=4; data.title = 'Tambahan'"
                        :class="{ 'bg-green-700 text-white': data.currentIndex == 4 }">
                        Tambahan
                    </button> --}}

                        {{-- <button disabled type="button"
                    class="w-full px-4 py-2 font-medium text-left bg-gray-100 rounded-b-lg cursor-not-allowed dark:bg-gray-600 dark:text-gray-400">
                    Download
                </button> --}}
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="bg-white/50 backdrop-filter backdrop-blur-md w-full rounded-l-lg p-4">
                        <span
                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gray-600 text-white uppercase mb-4"
                            v-text="data.title">
                        </span>
                        <div class="flex justify-center mb-4">
                            <img src="{{ $student->student_image ? asset('storage/student-photos/' . $student->student_image) : asset('bakid/default_image.jpg') }}"
                                onerror="this.onerror=null;this.src='{{ asset('bakid/default-profile.png') }}';"
                                class="flex justify-center rounded-full w-40 h-40 object-cover hover:rounded-none hover:w-1/2 hover:h-auto"
                                v-show="data.currentIndex==0" />
                            <img src="{{ $student->parent?->parent_image ? asset('storage/parent-photos/' . $student->parent?->parent_image) : asset('bakid/default-profile.png') }}"
                                class="flex justify-center rounded-full w-40 h-40 object-cover"
                                v-show="data.currentIndex==1"
                                onerror="this.onerror=null;this.src='{{ asset('bakid/default-profile.png') }}';" />
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3" v-show="data.currentIndex===0">
                            <div class="col">
                                <x-splade-input name="name" label="{{ __('bakid.name') }}" />

                                <x-splade-input class="mt-2" name="nickname" type="text" :label="__('bakid.nickname')" />

                                <x-splade-input class="mt-2" name="nik" type="text" :label="__('bakid.nik')" />


                                <x-splade-input class="mt-2" name="place_of_birth" type="text" :label="__('bakid.place_of_birth')" />


                                <x-splade-input class="mt-2" name="date_of_birth" date :label="__('bakid.date_of_birth')" />


                                <x-splade-select name="gender" v-model="form.gender" :label="__('bakid.gender')" class="mt-2"
                                    :options="['Laki-laki', 'Perempuan']">
                                </x-splade-select>

                                <x-splade-select name="province" v-model="form.province" remote-url="/api/locations"
                                    :label="__('bakid.province') . ' (' . $student->province . ')'" option-label="name" option-value="id" class="capitalize mt-2" />

                                <x-splade-select name="city" remote-url="`/api/locations/${form.province}/cities`"
                                    :label="__('bakid.city') . ' (' . $student->city . ')'" option-label="name" option-value="id" class="capitalize mt-2" />
                            </div>
                            <div class="col">
                                <x-splade-select name="district" remote-url="`/api/locations/${form.city}/districts`"
                                    :label="__('bakid.district') . ' (' . $student->district . ')'" option-label="name" option-value="id" class="capitalize" />

                                <x-splade-select name="village" remote-url="`/api/locations/${form.district}/villages`"
                                    :label="__('bakid.village') . ' (' . $student->village . ')'" option-label="name" option-value="id" class="capitalize mt-2" />

                                <x-splade-input class="mt-2" name="address" type="text" :label="__('bakid.address')"
                                    :placeholder="__('bakid.pl.address')" />


                                <x-splade-input class="mt-2" name="rt_rw" type="text" :label="__('bakid.rt_rw')"
                                    :placeholder="__('bakid.pl.rt_rw')" />


                                <x-splade-input class="mt-2" name="postal_code" type="text" :label="__('bakid.postal_code')"
                                    :placeholder="__('bakid.pl.postal_code')" />

                                <x-splade-input class="mt-2" name="religion" type="text" :label="__('bakid.religion')"
                                    :placeholder="__('bakid.pl.religion')" />

                                <x-splade-select class="mt-2" name="nationality" :options="['WNI', 'WNA']" :label="__('bakid.nationality')"
                                    :placeholder="__('bakid.pl.nationality')" choices="{searchEnabled:false}" />

                                <div class="flex justify-start gap-2">

                                    <x-splade-input class="mt-2" name="child_number" type="number"
                                        :label="__('bakid.child_number')" />

                                    <x-splade-input class="mt-2" name="siblings" type="number"
                                        :label="__('bakid.siblings')" />
                                </div>
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3" v-show="data.currentIndex===1">
                            <div>
                                <x-splade-input class="mt-2" name="parent.father_name" type="text"
                                    :label="__('bakid.father_name')" :placeholder="__('bakid.pl.father_name')" />

                                <x-splade-input class="mt-2" name="parent.father_nik" type="text"
                                    :label="__('bakid.father_nik')" :placeholder="__('bakid.pl.father_nik')" />

                                <x-splade-input class="mt-2" name="parent.father_phone" type="text"
                                    :label="__('bakid.father_phone')" :placeholder="__('bakid.pl.father_phone')" />

                                <x-splade-input class="mt-2" name="parent.father_education" type="text"
                                    :label="__('bakid.father_education')" :placeholder="__('bakid.pl.father_education')" />

                                <x-splade-input class="mt-2" name="parent.father_job" type="text"
                                    :label="__('bakid.father_job')" :placeholder="__('bakid.pl.father_job')" />

                                <x-splade-input class="mt-2" name="parent.father_income" type="text"
                                    :label="__('bakid.father_income')" :placeholder="__('bakid.pl.father_income')" />


                            </div>
                            <div>
                                <x-splade-input class="mt-2" name="parent.mother_name" type="text"
                                    :label="__('bakid.mother_name')" :placeholder="__('bakid.pl.mother_name')" />

                                <x-splade-input class="mt-2" name="parent.mother_nik" type="text"
                                    :label="__('bakid.mother_nik')" :placeholder="__('bakid.pl.mother_nik')" />

                                <x-splade-input class="mt-2" name="parent.mother_phone" type="text"
                                    :label="__('bakid.mother_phone')" :placeholder="__('bakid.pl.mother_phone')" />

                                <x-splade-input class="mt-2" name="parent.mother_education" type="text"
                                    :label="__('bakid.mother_education')" :placeholder="__('bakid.pl.mother_education')" />

                                <x-splade-input class="mt-2" name="parent.mother_job" type="text"
                                    :label="__('bakid.mother_job')" :placeholder="__('bakid.pl.mother_job')" />

                                <x-splade-input class="mt-2" name="parent.mother_income" type="text"
                                    :label="__('bakid.mother_income')" :placeholder="__('bakid.pl.mother_income')" />

                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3" v-show="data.currentIndex===2">
                            <div>
                                <x-splade-select class="mt-2" name="hobby" :options="[
                                    'Membaca',
                                    'Menulis',
                                    'Melukis',
                                    'Fotografi',
                                    'Berkebun',
                                    'Memasak',
                                    'Olahraga',
                                    'Mendaki',
                                    'Menjahit',
                                    'Musik',
                                    'Menonton film',
                                    'Bermain game',
                                    'Bermain musik',
                                    'Menari',
                                    'Memancing',
                                    'Traveling',
                                    'Memasak',
                                    'Menggambar',
                                    'Koleksi barang antik',
                                    'Merakit model kit',
                                ]" :label="__('bakid.hobby')"
                                    choices="{searchEnabled:true}" />


                                <x-splade-input class="mt-2" name="ambition" type="text" :label="__('bakid.ambition')"
                                    :placeholder="__('bakid.pl.ambition')" />


                                <x-splade-input class="mt-2" name="housing_status" type="text"
                                    :label="__('bakid.housing_status')" :placeholder="__('bakid.pl.housing_status')" />


                                <x-splade-input class="mt-2" name="recidency_status" type="text"
                                    :label="__('bakid.recidency_status')" :placeholder="__('bakid.pl.recidency_status')" />


                            </div>
                            <div>
                                <x-splade-input class="mt-2" name="nism" type="text" :label="__('bakid.nism')"
                                    :placeholder="__('bakid.pl.nism')" />


                                <x-splade-input class="mt-2" name="kis" type="text" :label="__('bakid.kis')"
                                    :placeholder="__('bakid.pl.kis')" />


                                <x-splade-input class="mt-2" name="kip" type="text" :label="__('bakid.kip')"
                                    :placeholder="__('bakid.pl.kip')" />


                                <x-splade-input class="mt-2" name="kks" type="text" :label="__('bakid.kks')"
                                    :placeholder="__('bakid.pl.kks')" />


                                <x-splade-input class="mt-2" name="pkh" type="text" :label="__('bakid.pkh')"
                                    :placeholder="__('bakid.pl.pkh')" />

                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3" v-show="data.currentIndex===3">
                            <div>
                                <x-splade-file v-model="form.student_image" :show-filename="false" label="Foto Santri"
                                    filepond accept="image/png, image/jpg, image/jpeg" max-size="2MB"
                                    class="mt-2" />
                                <img class="w-full p-5" v-if="form.student_image" name="student_image"
                                    :src="form.$fileAsUrl('student_image')" class="mt-2" />
                            </div>
                            <div>
                                <x-splade-file v-model="form.parent_image" name="parent_image" :show-filename="false"
                                    label="Foto Ayah" filepond accept="image/png, image/jpg, image/jpeg"
                                    max-size="2MB" class="mt-2" />
                                <img class="w-full p-5" v-if="form.parent_image"
                                    :src="form.$fileAsUrl('parent_image')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-1 gap-3" v-show="data.currentIndex===4">
                            <x-splade-rehydrate on="kk-uploaded">
                                @if ($student->user->doc_kk)
                                    <img class="w-full p-5"
                                        src="{{ asset('storage/doc-kk/' . $student->user->doc_kk) }}"
                                        class="mt-2" />

                                    <Link href="#modalUploadKK"
                                        class="relative p-3 py-5 w-full bg-white/50 cursor-default rounded-xl">
                                    Perbarui KK
                                    </Link>
                                @else
                                    <Link href="#modalUploadKK"
                                        class="relative p-3 py-5 w-full bg-white/50 cursor-default rounded-xl"> Upload
                                    KK
                                @endif
                            </x-splade-rehydrate>
                        </div>

                        <x-splade-modal name="modalUploadKK">
                            <x-splade-form confirm="Perbarui KK"
                            confirm-text="Yakin memperbarui KK?" method="post" :action="route('user.upload-kk', $student->user->id)" stay background reset-on-success
                                @success="$splade.emit('kk-uploaded')">
                                <div>
                                    <x-splade-file v-model="form.doc_kk" :show-filename="false"
                                        label="Foto Kartu Keluarga" filepond max-size="3MB" class="mt-2" />
                                    <img class="w-full p-5" name="doc_kk" :src="form.$fileAsUrl('doc_kk')"
                                        class="mt-2" />

                                    <x-splade-submit v-if="form.doc_kk">
                                        Simpan Dokumen
                                    </x-splade-submit>
                                </div>
                            </x-splade-form>
                        </x-splade-modal>

                        <div class="grid sm:grid-cols-2 gap-3" v-show="data.currentIndex===5">

                            <div class="col-span-2">
                                Asrama saat ini : {{ $student->dormitory[0]?->name ?? '' }}
                                {{ $student->room[0]?->name ?? '' }}
                            </div>

                            <x-splade-select class="mb-3"
                                remote-url="`/api/dormitories/by-student-gender/{{ $student->id }}`"
                                option-label="name" option-value="id" name="dormitory_id"
                                placeholder="{{ __('Pilih Daerah') }}" />

                            <x-splade-select class="mb-3"
                                remote-url="`/api/rooms/by-dormitory/${form.dormitory_id}`" option-label="name"
                                option-value="id" name="room_id" placeholder="{{ __('Pilih Asrama') }}" />


                        </div>

                        <x-loading />
                        <x-splade-submit class="mt-4">
                            {{ __('Save changes') }}
                        </x-splade-submit>
                    </div>
                </div>
            </div>
        </x-splade-form>
    </x-splade-data>


</x-app-layout>
