@seoTitle(__('Santri Baru'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Santri Baru') }}
        </h2>
        </x-slot>
        {{-- back button --}}

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-3 lg:px-8">
                {{-- <div class="flex justify-start pb-3">
                    <Link href="{{ url()->previous() }}"
                        class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 ">
                    Kembali
                    </Link>
                </div> --}}
                {{-- <button
                    class="group bg-blue-500 hover:bg-blue-700 text-white rounded-full py-2 px-4 transition-all duration-300 relative">
                    <i class="fas fa-arrow-right mr-2"></i>
                    <span class="invisible group-hover:visible absolute left-0 ml-6">Button Text</span>
                </button> --}}

                {{-- <div class="relative w-max mx-auto">
                    <input type="text"
                        class="relative peer z-10 bg-transparent w-12 h-12 rounded-full border outline-none cursor-pointer

    focus:w-full focus:border-lime-300 focus:cursor-text
                    focus:pl-16 focus:pr-4
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                        viewBox="0 0 256 256"
                        class="absolute inset-y-0 my-auto h-8 w-12 border-transparent peer-focus:border-lime-300 peer-focus:stroke-lime-500">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
                        </path>
                    </svg>
                </div> --}}
                <div class="px-4 pb-3">
                    <Link href="{{ url()->previous() }}" class="relative w-max mx-auto">
                    <button
                        class=" group relative peer z-10 w-10 h-10 bg-transparent rounded-full border border-2 border-lime-600 outline-none cursor-pointer
                    hover:w-[150px]
                    transition-width duration-300
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                            viewBox="0 0 256 256"
                            class="absolute inset-y-0 ml-2 my-auto h-6 w-6 border-transparent peer-focus:border-lime-300 peer-focus:stroke-lime-500">
                            <path
                                d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
                            </path>
                        </svg>
                        <span class="invisible group-hover:visible">Kembali</span>
                    </button>
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-white bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                        <div>
                            {{-- <splade-input type="text" name="name" label="Nama" placeholder="Nama" /> --}}
                        </div>
                        <div>
                            adfs
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
