<div class="px-4 sm:pl-0 pb-3">
    <Link href="{{ $route ? route($route) : url()->previous() }}" class="relative w-max mx-auto">
    <button
        class=" group relative peer z-10 w-10 h-10 rounded-full ring-2 ring-white bg-slate-300/30  hover:bg-green-500 outline-none cursor-pointer
    hover:w-[150px]
    transition-width duration-300
    ">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"
            class="absolute inset-y-0 ml-2 my-auto h-6 w-6 border-transparent peer-focus:border-green-500 peer-focus:stroke-green-500">
            <path
                d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
            </path>
        </svg>
        <span class="invisible group-hover:visible">Kembali</span>
    </button>
    </Link>
</div>
