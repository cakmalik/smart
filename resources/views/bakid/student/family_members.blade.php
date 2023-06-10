@seoTitle(__('bakid.t.family_members'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('bakid.t.family_members') }}
        </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{-- card with image --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 px-3">
                    @foreach ($families as $i)
                        <x-card.image :dataa="$i" />
                    @endforeach
                    <Link href="{{ route('student.create') }}"
                        class="group relative items-center justify-center overflow-hidden cursor-pointer hover:shadow-black/30 transition-shadow rounded-lg">
                    <div class="h-70 w-62 md:h-80 md:w-72">

                    </div>
                    <div class="absolute inset-0 bg-black/50 group-hover:to-black/70">
                        <div class="invisible sm:visible absolute inset-0 flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="font-semibold  group-hover:invisible"
                                width="40" height="40" fill="#ffffff" viewBox="0 0 256 256">
                                <path
                                    d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center px-9 text-center translate-y-0 md:translate-y-[58%] group-hover:translate-y-0 transition-all duration-500">
                            <h3 class="text-2xl font-bold text-white mb-3 capitalize">Tambah</h3>
                        </div>
                    </div>
                    </Link>
                </div>
            </div>
        </div>
</x-app-layout>
