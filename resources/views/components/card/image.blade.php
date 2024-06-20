<div
    class="group relative items-center justify-center overflow-hidden cursor-pointer hover:shadow-black/30 transition-shadow rounded-lg">
    <div class="h-70 w-62 sm:h-80 w-72">
        <img src="{{ $dataa->student_image ? asset('storage/student-photos/' . $dataa->student_image) : asset('bakid/bg-bakid.png') }}"
            onerror="this.onerror=null;this.src='{{ asset('bakid/bg-bakid.png') }}';"
            class="h-full object-cover group-hover:rotate-1 group-hover:scale-125 transition-transform duration-500">
    </div>
    <div
        class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black group-hover:from-black/90 group-hover:via-black/60 group-hover:to-black/70">
        <div
            class="bg-black/50 absolute inset-0 flex flex-col items-center justify-center px-9 text-center  translate-y-[0%] sm:translate-y-[66%] group-hover:translate-y-0 transition-all duration-500 ">
            <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 capitalize">{{ $dataa->nickname == '-' ? $dataa->name : $dataa->nickname}}</h3>

            <p class="text-sm md:text-lg italic text-white group-hover:opacity-100 transition-opacity duration-300 ">
                {{-- {{ $lineOne }} --}}
                Asrama b29
            </p>

            <p
                class="text-sm md:text-lg italic text-white mb-3 group-hover:opacity-100 transition-opacity duration-300 ">
                {{-- {{ $lineTwo }} --}}
                Kelas Formal
            </p>
            <button
                class="rounded-full bg-neutral-900 py-1 px-2 md:py-2 md:px-3.5 text-sm capitalize text-white shadow shadow-black/60 ">
                {{-- {{ $buttonText }} --}}
                Selengkapnya
            </button>
        </div>
    </div>
</div>
