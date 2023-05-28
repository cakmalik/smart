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
            <x-button.back />
            <div class="bg-white/30 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <div class="bg-white bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8"> --}}
                <div class='p-5'>
                    <x-splade-form>
                        <x-splade-data remember="menu" default="{currentIndex: 0 }">
                            <ol
                                class="flex justify-center items-center w-full p-3 mb-6 space-x-2 text-sm font-medium text-center text-gray-500 bg-slate-800 backdrop-blur-md border-none rounded-none shadow-none dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4">
                                <li class="flex items-center"
                                    :class="{ 'text-green-600 dark:text-green-500': data.currentIndex === 0 }">
                                    <span
                                        class="flex items-center justify-center w-5 h-5 mr-2 text-xs border rounded-full shrink-0"
                                        :class="{
                                            'border-green-600 dark:border-green-500': data.currentIndex ===
                                                0,
                                            'border-gray-600': data.currentIndex != 0
                                        }">
                                        1
                                    </span>
                                    Informasi <span class="hidden sm:inline-flex sm:ml-2">Pribadi</span>
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                    </svg>
                                </li>
                                <li class="flex items-center"
                                    :class="{ 'text-green-600 dark:text-green-500': data.currentIndex === 1 }">
                                    <span
                                        class="flex items-center justify-center w-5 h-5 mr-2 text-xs border rounded-full shrink-0"
                                        :class="{
                                            'border-green-600 dark:border-green-500': data.currentIndex ===
                                                1,
                                            'border-gray-600': data.currentIndex != 1
                                        }">
                                        2
                                    </span>
                                    Orang <span class="hidden sm:inline-flex sm:ml-2">Tua</span>
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                    </svg>
                                </li>
                                <li class="flex items-center"
                                    :class="{ 'text-green-600 dark:text-green-500': data.currentIndex === 2 }">
                                    <span
                                        class="flex items-center justify-center w-5 h-5 mr-2 text-xs border  rounded-full shrink-0"
                                        :class="{
                                            'border-green-600 dark:border-green-500': data.currentIndex ===
                                                2,
                                            'border-gray-600': data.currentIndex != 2
                                        }">
                                        3
                                    </span>
                                    Personal <span class="hidden sm:inline-flex sm:ml-2">Info</span>

                                </li>

                            </ol>

                            <aside v-show="data.currentIndex === 0">
                                <div class="grid sm:grid-cols-2 gap-3">
                                    <div>
                                        <x-splade-input class="mb-3" name="email" type="email" :label="__('bakid.name')"
                                            :placeholder="__('bakid.pl.name')" />
                                        <x-splade-input class="mb-3" name="nik" type="text" :label="__('bakid.nik')"
                                            :placeholder="__('bakid.pl.nik')" />

                                        <x-splade-input class="mb-3" name="place_of_birth" type="text"
                                            :label="__('bakid.place_of_birth')" :placeholder="__('bakid.pl.place_of_birth')" />

                                        <x-splade-input class="mb-3" name="date_of_birth" type="date"
                                            :label="__('bakid.date_of_birth')" :placeholder="__('bakid.pl.date_of_birth')" />

                                        <x-splade-select name="gender" :label="__('bakid.gender')">
                                            <option value="male">Laki-laki</option>
                                            <option value="female">Perempuan</option>
                                        </x-splade-select>

                                        <x-splade-input class="mb-3" name="address" type="text" :label="__('bakid.address')"
                                            :placeholder="__('bakid.pl.address')" />

                                        <x-splade-input class="mb-3" name="rt_rw" type="text" :label="__('bakid.rt_rw')"
                                            :placeholder="__('bakid.pl.rt_rw')" />

                                        <x-splade-input class="mb-3" name="village" type="text" :label="__('bakid.village')"
                                            :placeholder="__('bakid.pl.village')" />

                                        <x-splade-input class="mb-3" name="district" type="text" :label="__('bakid.district')"
                                            :placeholder="__('bakid.pl.district')" />

                                        <x-splade-input class="mb-3" name="city" type="text" :label="__('bakid.city')"
                                            :placeholder="__('bakid.pl.city')" />

                                        <x-splade-input class="mb-3" name="province" type="text" :label="__('bakid.province')"
                                            :placeholder="__('bakid.pl.province')" />

                                        <x-splade-input class="mb-3" name="postal_code" type="text"
                                            :label="__('bakid.postal_code')" :placeholder="__('bakid.pl.postal_code')" />

                                        <x-splade-input class="mb-3" name="religion" type="text" :label="__('bakid.religion')"
                                            :placeholder="__('bakid.pl.religion')" />

                                        <x-splade-input class="mb-3" name="nationality" type="text"
                                            :label="__('bakid.nationality')" :placeholder="__('bakid.pl.nationality')" />

                                        <x-splade-input class="mb-3" name="phone" type="text" :label="__('bakid.phone')"
                                            :placeholder="__('bakid.pl.phone')" />



                                    </div>
                                    <div>

                                        <x-splade-input class="mb-3" name="student_image" type="text"
                                            :label="__('bakid.student_image')" :placeholder="__('bakid.pl.student_image')" />

                                        <x-splade-input class="mb-3" name="parent_image" type="text"
                                            :label="__('bakid.parent_image')" :placeholder="__('bakid.pl.parent_image')" />

                                        <x-splade-input class="mb-3" name="nis" type="text" :label="__('bakid.nis')"
                                            :placeholder="__('bakid.pl.nis')" />

                                        <x-splade-input class="mb-3" name="hobby" type="text" :label="__('bakid.hobby')"
                                            :placeholder="__('bakid.pl.hobby')" />

                                        <x-splade-input class="mb-3" name="ambition" type="text" :label="__('bakid.ambition')"
                                            :placeholder="__('bakid.pl.ambition')" />

                                        <x-splade-input class="mb-3" name="housing_status" type="text"
                                            :label="__('bakid.housing_status')" :placeholder="__('bakid.pl.housing_status')" />

                                        <x-splade-input class="mb-3" name="recidency_status" type="text"
                                            :label="__('bakid.recidency_status')" :placeholder="__('bakid.pl.recidency_status')" />

                                        <x-splade-input class="mb-3" name="nism" type="text"
                                            :label="__('bakid.nism')" :placeholder="__('bakid.pl.nism')" />

                                        <x-splade-input class="mb-3" name="kis" type="text"
                                            :label="__('bakid.kis')" :placeholder="__('bakid.pl.kis')" />

                                        <x-splade-input class="mb-3" name="kip" type="text"
                                            :label="__('bakid.kip')" :placeholder="__('bakid.pl.kip')" />

                                        <x-splade-input class="mb-3" name="kks" type="text"
                                            :label="__('bakid.kks')" :placeholder="__('bakid.pl.kks')" />

                                        <x-splade-input class="mb-3" name="pkh" type="text"
                                            :label="__('bakid.pkh')" :placeholder="__('bakid.pl.pkh')" />
                                    </div>
                                </div>
                            </aside>

                            <aside v-show="data.currentIndex === 1">
                                inu
                            </aside>

                            <aside v-show="data.currentIndex === 2">
                                ine
                            </aside>

                            <div class="flex justify-end mt-6 gap-2">
                                <span
                                    class="cursor-pointer px-4 py-2 bg-slate-800 text-green-400 rounded-lg hover:bg-slate-900 hover:text-green-500"
                                    v-show="data.currentIndex > 0"
                                    @click="data.currentIndex = data.currentIndex - 1;">{{ __('pagination.previous') }}</span>
                                <span
                                    class="cursor-pointer px-4 py-2 bg-slate-800 text-green-400 rounded-lg hover:bg-slate-900 hover:text-green-500"
                                    v-show="data.currentIndex < 2"
                                    @click="data.currentIndex = data.currentIndex + 1;">{{ __('pagination.next') }}</span>
                            </div>
                        </x-splade-data>
                    </x-splade-form>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
