<div
    class="group relative items-center justify-center overflow-hidden cursor-pointer hover:shadow-black/30 transition-shadow rounded-lg">
    <div class="h-70 w-62 sm:h-80 w-72">
        <img src="https://images.unsplash.com/photo-1623366302587-b38b1ddaefd9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cG9ydHJhaXQlMjBtYW58ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60"
            class="h-full object-cover group-hover:rotate-1 group-hover:scale-125 transition-transform duration-500">
    </div>
    <div
        class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black group-hover:from-black/70 group-hover:via-black/60 group-hover:to-black/70">
        <div
            class="absolute inset-0 flex flex-col items-center justify-center px-9 text-center translate-y-[58%] group-hover:translate-y-0 transition-all duration-500">
            <h3 class="text-2xl font-bold text-white mb-3 capitalize">{{ $name }}</h3>

            <p class="text-lg italic text-white group-hover:opacity-100 transition-opacity duration-300 ">
                {{ $lineOne }}
            </p>

            <p class="text-lg italic text-white mb-3 group-hover:opacity-100 transition-opacity duration-300 ">
                {{ $lineTwo }}
            </p>
            <button
                class="rounded-full bg-neutral-900 py-2 px-3.5 text-sm capitalize text-white shadow shadow-black/60 ">
                {{ $buttonText }}
            </button>
        </div>
    </div>
</div>
