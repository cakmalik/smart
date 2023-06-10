@seoTitle(__('Santri Baru'))

<x-app-layout>
    {{-- <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Santri Baru') }}
        </h2>
        </x-slot> --}}
    {{-- back button --}}

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-3 lg:px-8">
            <x-button.back route="dashboard" />
            {{-- <x-splade-toggle>
                <button @click.prevent="toggle">Toggle message</button>

                <x-splade-transition show="toggled">
                    Welcome!
                </x-splade-transition>
                <x-splade-transition show="toggled" enter="transition-opacity duration-100" enter-from="opacity-0"
                    enter-to="opacity-100" leave="transition-opacity duration-" leave-from="opacity-100"
                    leave-to="opacity-0">
                    ...
                </x-splade-transition>
                <x-splade-transition animation="slide-left" show="toggled">
                    ...
                </x-splade-transition>
            </x-splade-toggle> --}}

            <div class="bg-white/40 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <div class="bg-white bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8"> --}}
                <div class='p-5'>
                    <x-splade-form :action="route('student.store')" default="{nationality:'WNI'}" {{-- confirm="Simpan"
                        confirm-text="Apakah anda yakin semua data sudah benar?" confirm-button="Ya, simpan!" --}}
                        cancel-button="Batal">
                        <x-splade-data remember="menu" default="{currentIndex: 0, religion:'Islam' }">
                            <ol
                                class="flex justify-center items-center w-full p-3 mb-6 space-x-2 text-sm font-medium text-center text-gray-500 bg-slate-800 backdrop-blur-md border-none rounded-none shadow-none dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4">
                                <li class="flex items-center"
                                    :class="{ 'text-green-400 dark:text-green-500': data.currentIndex === 0 }">
                                    <span
                                        class="flex items-center justify-center w-5 h-5 mr-2 text-xs border rounded-full shrink-0"
                                        :class="{
                                            'border-green-400 dark:border-green-500': data.currentIndex ===
                                                0,
                                            'border-gray-600': data.currentIndex != 0
                                        }">
                                        1
                                    </span>
                                    Data <span class="hidden sm:inline-flex sm:ml-2">Pribadi</span>
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                    </svg>
                                </li>
                                <li class="flex items-center"
                                    :class="{ 'text-green-400 dark:text-green-500': data.currentIndex === 1 }">
                                    <span
                                        class="flex items-center justify-center w-5 h-5 mr-2 text-xs border rounded-full shrink-0"
                                        :class="{
                                            'border-green-400 dark:border-green-500': data.currentIndex ===
                                                1,
                                            'border-gray-600': data.currentIndex != 1
                                        }">
                                        2
                                    </span>
                                    Orang <span class="hidden sm:inline-flex sm:ml-2">Tua / Wali</span>
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                    </svg>
                                </li>
                                <li class="flex items-center"
                                    :class="{ 'text-green-400 dark:text-green-500': data.currentIndex === 2 }">
                                    <span
                                        class="flex items-center justify-center w-5 h-5 mr-2 text-xs border  rounded-full shrink-0"
                                        :class="{
                                            'border-green-400 dark:border-green-500': data.currentIndex ===
                                                2,
                                            'border-gray-600': data.currentIndex != 2
                                        }">
                                        3
                                    </span>
                                    Informasi <span class="hidden sm:inline-flex sm:ml-2">Tambahan</span>
                                </li>
                            </ol>

                            <aside v-show="data.currentIndex === 0">
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div>
                                        <x-splade-input class="mt-2" name="name" type="text" :label="__('bakid.name')"
                                            :placeholder="__('bakid.pl.name')" />

                                        <x-splade-input class="mt-2" name="nickname" type="text" :label="__('bakid.nickname')"
                                            :placeholder="__('bakid.pl.nickname')" />

                                        <x-splade-input class="mt-2" name="nik" type="text" :label="__('bakid.nik')"
                                            :placeholder="__('bakid.pl.nik')" />


                                        <x-splade-input class="mt-2" name="place_of_birth" type="text"
                                            :label="__('bakid.place_of_birth')" :placeholder="__('bakid.pl.place_of_birth')" />


                                        <x-splade-input class="mt-2" name="date_of_birth" date :label="__('bakid.date_of_birth')"
                                            :placeholder="__('bakid.pl.date_of_birth')" />


                                        <x-splade-select name="gender" v-model="form.gender" :label="__('bakid.gender')"
                                            class="mt-2" :options="['Laki-laki', 'Perempuan']">
                                        </x-splade-select>

                                        <x-splade-select v-model="form.province" remote-url="/api/locations"
                                            :label="__('bakid.province')" option-label="name" option-value="id"
                                            class="capitalize mt-2" />

                                        <x-splade-select name="city"
                                            remote-url="`/api/locations/${form.province}/cities`" :label="__('bakid.city')"
                                            option-label="name" option-value="id" class="capitalize mt-2" />
                                    </div>
                                    <div>
                                        <x-splade-select name="district"
                                            remote-url="`/api/locations/${form.city}/districts`" :label="__('bakid.district')"
                                            option-label="name" option-value="id" class="capitalize mt-2" />

                                        <x-splade-select name="village"
                                            remote-url="`/api/locations/${form.district}/villages`" :label="__('bakid.village')"
                                            option-label="name" option-value="id" class="capitalize mt-2" />

                                        <x-splade-input class="mt-2" name="address" type="text" :label="__('bakid.address')"
                                            :placeholder="__('bakid.pl.address')" />


                                        <x-splade-input class="mt-2" name="rt_rw" type="text" :label="__('bakid.rt_rw')"
                                            :placeholder="__('bakid.pl.rt_rw')" />


                                        <x-splade-input class="mt-2" name="postal_code" type="text"
                                            :label="__('bakid.postal_code')" :placeholder="__('bakid.pl.postal_code')" />


                                        <x-splade-select class="mt-2" name="religion" v-model="data.religion"
                                            :options="['Islam']" :label="__('bakid.religion')" :placeholder="__('bakid.pl.religion')"
                                            choices="{searchEnabled:false}" />

                                        <x-splade-select class="mt-2" name="nationality" :options="['WNI', 'WNA']"
                                            :label="__('bakid.nationality')" :placeholder="__('bakid.pl.nationality')" choices="{searchEnabled:false}" />

                                        <div class="flex justify-center gap-2">

                                            <x-splade-input class="mt-2" name="child_number" type="number"
                                                :label="__('bakid.child_number')" />

                                            <x-splade-input class="mt-2" name="siblings" type="number"
                                                :label="__('bakid.siblings')" />

                                        </div>

                                    </div>
                                </div>
                            </aside>

                            <aside v-show="data.currentIndex === 1">
                                <div class="grid sm:grid-cols-2 gap-3">
                                    <div>
                                        <x-splade-input class="mt-2" name="father_name" type="text"
                                            :label="__('bakid.father_name')" :placeholder="__('bakid.pl.father_name')" />

                                        <x-splade-input class="mt-2" name="father_nik" type="text"
                                            :label="__('bakid.father_nik')" :placeholder="__('bakid.pl.father_nik')" />

                                        <x-splade-input class="mt-2" name="father_phone" type="text"
                                            :label="__('bakid.father_phone')" :placeholder="__('bakid.pl.father_phone')" />

                                        <x-splade-input class="mt-2" name="father_education" type="text"
                                            :label="__('bakid.father_education')" :placeholder="__('bakid.pl.father_education')" />

                                        <x-splade-input class="mt-2" name="father_job" type="text"
                                            :label="__('bakid.father_job')" :placeholder="__('bakid.pl.father_job')" />

                                        <x-splade-input class="mt-2" name="father_income" type="text"
                                            :label="__('bakid.father_income')" :placeholder="__('bakid.pl.father_income')" />


                                    </div>
                                    <div>
                                        <x-splade-input class="mt-2" name="mother_name" type="text"
                                            :label="__('bakid.mother_name')" :placeholder="__('bakid.pl.mother_name')" />

                                        <x-splade-input class="mt-2" name="mother_nik" type="text"
                                            :label="__('bakid.mother_nik')" :placeholder="__('bakid.pl.mother_nik')" />

                                        <x-splade-input class="mt-2" name="mother_phone" type="text"
                                            :label="__('bakid.mother_phone')" :placeholder="__('bakid.pl.mother_phone')" />

                                        <x-splade-input class="mt-2" name="mother_education" type="text"
                                            :label="__('bakid.mother_education')" :placeholder="__('bakid.pl.mother_education')" />

                                        <x-splade-input class="mt-2" name="mother_job" type="text"
                                            :label="__('bakid.mother_job')" :placeholder="__('bakid.pl.mother_job')" />

                                        <x-splade-input class="mt-2" name="mother_income" type="text"
                                            :label="__('bakid.mother_income')" :placeholder="__('bakid.pl.mother_income')" />

                                    </div>
                                </div>
                                <div class="grid sm:grid-cols-2">
                                    <div class="div">
                                    </div>
                                </div>
                            </aside>

                            <aside v-show="data.currentIndex === 2">
                                <div class="grid sm:grid-cols-2 gap-3">
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
                                        ]"
                                            :label="__('bakid.hobby')" choices="{searchEnabled:true}" />


                                        <x-splade-input class="mt-2" name="ambition" type="text"
                                            :label="__('bakid.ambition')" :placeholder="__('bakid.pl.ambition')" />


                                        <x-splade-input class="mt-2" name="housing_status" type="text"
                                            :label="__('bakid.housing_status')" :placeholder="__('bakid.pl.housing_status')" />


                                        <x-splade-input class="mt-2" name="recidency_status" type="text"
                                            :label="__('bakid.recidency_status')" :placeholder="__('bakid.pl.recidency_status')" />


                                    </div>
                                    <div>
                                        <x-splade-input class="mt-2" name="nism" type="text"
                                            :label="__('bakid.nism')" :placeholder="__('bakid.pl.nism')" />


                                        <x-splade-input class="mt-2" name="kis" type="text"
                                            :label="__('bakid.kis')" :placeholder="__('bakid.pl.kis')" />


                                        <x-splade-input class="mt-2" name="kip" type="text"
                                            :label="__('bakid.kip')" :placeholder="__('bakid.pl.kip')" />


                                        <x-splade-input class="mt-2" name="kks" type="text"
                                            :label="__('bakid.kks')" :placeholder="__('bakid.pl.kks')" />


                                        <x-splade-input class="mt-2" name="pkh" type="text"
                                            :label="__('bakid.pkh')" :placeholder="__('bakid.pl.pkh')" />

                                    </div>
                                </div>
                            </aside>

                            <aside v-show="data.currentIndex===3">
                                <div class="grid sm:grid-cols-2 gap-3">
                                    <div>
                                        <x-splade-file name="student_image" :show-filename="false" filepond
                                            label="Foto Santri" class="mt-2" />
                                        <img class="w-full p-5" v-if="form.student_image"
                                            :src="form.$fileAsUrl('student_image')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-splade-file name="parent_image" :show-filename="false" filepond
                                            label="Foto Ayah" class="mt-2" />
                                        <img class="w-full p-5" v-if="form.parent_image"
                                            :src="form.$fileAsUrl('parent_image')" class="mt-2" />
                                    </div>
                                </div>

                            </aside>

                            <div class="flex justify-between mt-6 gap-2">
                                <span
                                    class="cursor-pointer px-4 py-2 bg-slate-800 text-green-400 rounded-full hover:bg-slate-900 hover:text-green-500"
                                    v-show="data.currentIndex > 0"
                                    @click="data.currentIndex = data.currentIndex - 1;">{{ __('pagination.previous') }}</span>
                                <span v-show="data.currentIndex == 0"></span>
                                <span
                                    class="cursor-pointer px-4 py-2 bg-slate-800 text-green-400 rounded-full hover:bg-slate-900 hover:text-green-500"
                                    v-show="data.currentIndex < 3"
                                    @click="data.currentIndex = data.currentIndex + 1;">{{ __('pagination.next') }}</span>
                                {{-- <button
                                    class="cursor-pointer px-4 py-2 bg-grren-400 text-slate-700 outline outline-2 rounded-lg hover:bg-green-500 hover:text-slate-800"
                                    v-show="data.currentIndex >=3">{{ __('pagination.submit') }}</button> --}}
                                <x-splade-submit label="Simpan" :spinner="true" v-show="data.currentIndex >=3"
                                    @click="data.currentIndex=0" />
                            </div>
                        </x-splade-data>
                    </x-splade-form>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
