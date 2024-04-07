@seoTitle(__('Rooms'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Rooms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl h-full mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-col md:grid-cols-2 gap-3">
                <div class="bg-white/50 backdrop-filter backdrop-blur-md sm:rounded-lg p-4 border border-white">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="inline-flex items-center gap-3 ">
                            <span class="bg-yellow-400 p-1 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M240,208H224V96a16,16,0,0,0-16-16H144V32a16,16,0,0,0-24.88-13.32L39.12,72A16,16,0,0,0,32,85.34V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM208,96V208H144V96ZM48,85.34,128,32V208H48ZM112,112v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm-32,0v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm0,56v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Zm32,0v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Z">
                                    </path>
                                </svg>
                            </span>
                            <span class="text-xl text-slate-900 font-semibold"> Pendidikan Formal</span>
                        </h3>
                        <div class="inline-flex items-center gap-2">

                            {{-- <x-splade-form submit-on-change method="GET" :action="route('dormitory.index')"
                                    @success="$splade.emit('dormitories-changed')">
                                    <select name="gender" v-model="form.gender" class="rounded-full h-7 text-sm py-0">
                                        <option value="">Filter</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </x-splade-form> --}}


                            <Link href="#addDormitory"><svg xmlns="http://www.w3.org/2000/svg" width="32"
                                height="32" fill="#000000" viewBox="0 0 256 256">
                                <path
                                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z">
                                </path>
                            </svg></Link>

                            {{-- start modal create --}}
                            {{-- <x-splade-modal position="center" max-width="lg" name="addDormitory" close-explicitly>
                                    <x-splade-form :action="route('dormitory.store')" method="POST" stay background reset-on-success
                                        @success="$splade.emit('dormitory-added')">
                                        <x-splade-select name="gender" label="Daerah Untuk" class="mb-3">
                                            <option value="">Pilih</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </x-splade-select>
                                        <x-splade-input name="name" placeholder="Nama daerah" class="mb-3" />
                                        <x-splade-input name="capacity" type="number"
                                            placeholder="Kapasitas maksimal santri" class="mb-3" />
                                        <x-splade-input name="rooms" type="number" placeholder="Jumlah asrama"
                                            class="mb-3" />
                                        <div class="flex justify-end">
                                            <x-splade-button type="submit"
                                                class="text-base text-white rounded-full  bg-green-500 hover:bg-green-600">
                                                Tambah
                                            </x-splade-button>
                                        </div>
                                    </x-splade-form>
                                </x-splade-modal> --}}
                            {{-- end modal create --}}

                        </div>
                    </div>
                    {{-- start container --}}
                    <div class="overflow-hidden rounded-lg">
                        <div class="h-[55vh] overflow-y-scroll">
                            <div class="grid grid-col sm:grid-cols-2 gap-2">
                                {{-- start template card --}}
                                <x-splade-rehydrate>
                                    <div class="relative bg-white rounded-lg overflow-hidden pt-3 z-40">
                                        {{-- <div
                                                class="absolute text-white opacity-40 text-9xl font-extrabold right-10 rotate-4 text-center z-1 pointer-events-none">
                                                name</div> --}}
                                        <div class="px-3 flex justify-between">
                                            <span>Nama</span>
                                            <span class="bg-gr text-2xl font-semibold">name</span>
                                        </div>
                                        <div class="px-3 flex justify-between">
                                            <p>Jumlah Asrama</p>
                                            <span class="">rooms</span>
                                        </div>
                                        <div class="px-3 flex justify-between">
                                            <p>Kapasitas</p>
                                            <span class="">capacity</span>
                                        </div>
                                        <div class="px-3 flex justify-between">
                                            <p>Jumlah Santri</p>
                                            <span class="">0</span>
                                        </div>
                                        <div class="px-3 flex justify-between">
                                            <p>Tersedia</p>
                                            <span class="">0</span>
                                        </div>

                                        <div class="flex justify-center gap-2 bg-green-500 p-1 z-50">
                                            <x-splade-link
                                                class="border hover:border-gray-600 duration-200 bg-lime-300 cursor-pointer p-1 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    fill="##ffffff" viewBox="0 0 256 256">
                                                    <path
                                                        d="M152,112a8,8,0,0,1-8,8H120v24a8,8,0,0,1-16,0V120H80a8,8,0,0,1,0-16h24V80a8,8,0,0,1,16,0v24h24A8,8,0,0,1,152,112Zm77.66,117.66a8,8,0,0,1-11.32,0l-50.06-50.07a88.11,88.11,0,1,1,11.31-11.31l50.07,50.06A8,8,0,0,1,229.66,229.66ZM112,184a72,72,0,1,0-72-72A72.08,72.08,0,0,0,112,184Z">
                                                    </path>
                                                </svg>
                                            </x-splade-link>
                                            <Link
                                                class="border hover:border-gray-600 duration-200 bg-lime-300 cursor-pointer p-1 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                fill="##ffffff" viewBox="0 0 256 256">
                                                <path
                                                    d="M240,100.68a15.86,15.86,0,0,0-4.69-11.31L166.63,20.68a16,16,0,0,0-22.63,0L115.57,49.11l-58,21.77A16.06,16.06,0,0,0,47.35,83.23L24.11,222.68A8,8,0,0,0,32,232a8.4,8.4,0,0,0,1.32-.11l139.44-23.24a16,16,0,0,0,12.35-10.17l21.77-58L235.31,112A15.87,15.87,0,0,0,240,100.68Zm-69.87,92.19L55.32,212l47.37-47.37a28,28,0,1,0-11.32-11.32L44,200.7,63.13,85.86,118,65.29,190.7,138ZM104,140a12,12,0,1,1,12,12A12,12,0,0,1,104,140Zm96-15.32L131.31,56l24-24L224,100.68Z">
                                                </path>
                                            </svg>
                                            </Link>
                                        </div>
                                    </div>
                                </x-splade-rehydrate>
                                {{-- end template card --}}
                            </div>
                        </div>
                    </div>
                    {{-- end container --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
