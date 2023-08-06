@seoTitle(__('Welcome'))

<div class="relative min-h-screen bg-gray-100 bg-center flex justify-center items-center bg-dots-darker selection:bg-red-500 selection:text-white "
    style="background-image: url('{{ asset('bg/1.jpg') }}'); background-size:cover; background-position: 25% 75%">
    {{-- @if ($canLogin)
        <div class="p-6 text-right sm:fixed sm:top-0 sm:right-0">
            @auth
                <Link href="{{ url('/dashboard') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Dashboard</Link>
            @else
                <Link href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in</Link>

                @if ($canRegister)
                    <Link href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Register</Link>
                @endif
            @endauth
        </div>
    @endif --}}

    {{-- <div class="p-6 mx-auto rounded-lg max-w-7xl lg:p-8 bg-white/20 backdrop-blur-md outline outline-1 outline-slate-50"> --}}
    <div class="p-6 mx-auto rounded-lg max-w-7xl lg:p-8 bg-black/20 border border-slate-600">
        <div class="flex justify-center">
            <x-authentication-card-logo />
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">

            </div>
        </div>

        <div class="flex justify-center gap-3 px-0 mt-16 sm:items-center sm:justify-between">
            @if ($canLogin)
                @auth
                    <Link href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Dashboard</Link>
                @else
                    <Link href="{{ route('login') }}"
                        class="relative flex items-center justify-center p-2 px-10 py-2 overflow-hidden font-medium transition duration-300 ease-out border-2 rounded-full text-white-500 border-white-500 group">
                    <span
                        class="absolute flex items-center justify-center w-full h-full text-white duration-300 translate-x-full bg-green-500 group-hover:translate-x-0 ease">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#FFFFFF"
                            viewBox="0 0 256 256">
                            <path
                                d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
                            </path>
                        </svg>
                    </span>
                    <span
                        class="absolute flex items-center justify-center w-full h-full text-white transition-all duration-300 transform bg-green-500 sm:bg-transparent group-hover:translate-x-full ease">Masuk</span>
                    <span class="relative invisible">Masuk</span>
                    </Link>

                    @if ($canRegister)
                        <Link href="{{ route('register') }}"
                            class="relative flex items-center justify-center p-2 px-10 py-2 overflow-hidden font-medium transition duration-300 ease-out border-2 rounded-full text-white-500 border-white-500 group">
                        <span
                            class="absolute flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-green-500 group-hover:translate-x-0 ease">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#FFFFFF"
                                viewBox="0 0 256 256">
                                <path
                                    d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z">
                                </path>
                            </svg>
                        </span>
                        <span
                            class="absolute flex items-center justify-center w-full h-full text-white transition-all duration-300 transform bg-green-500 sm:bg-transparent group-hover:-translate-x-full ease">Buat
                            Akun</span>
                        <span class="relative invisible">Buat Akun</span>
                        </Link>
                    @endif
                @endauth

            @endif

        </div>
    </div>
</div>
