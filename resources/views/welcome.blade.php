    @seoTitle(__('Welcome'))
    <div class="flex h-screen flex-col justify-center overflow-hidden bg-cover bg-hero-pattern sm:hidden">
        <div class="h-1/3 p-5 flex flex-col justify-center items-center">
            <div class="flex items-center justify-center mt-5 gap-2">
                @if ($canLogin)
                @auth
                <Link href="{{ url('/dashboard') }}"
                class="py-2 px-3 uppercase font-semibold rounded border-[0.5px] border-white text-white bg-white/30 backdrop-blur-sm">
                {{ __('Dashboard') }}</Link>
                @else
                        <Link href="{{ route('login') }}"
                            class="py-2 px-3 uppercase font-semibold rounded border-[0.5px] border-white text-white bg-white/30 backdrop-blur-sm">
                        {{ __('Login') }}</Link>

                        @if ($canRegister)
                            <Link href="{{ route('register') }}"
                                class="ml-4 py-2 px-3 uppercase font-semibold rounded border-[0.5px] border-white text-white bg-white/30 backdrop-blur-sm">
                            {{ __('Register') }}</Link>
                        @endif
                    @endauth
                @endif

                {{-- <button
                    class="py-2 px-3 uppercase font-semibold rounded border-[0.5px] border-white text-white bg-white/30 backdrop-blur-sm">{{ __('Masuk') }}</button>
                <button
                    class="py-2 px-3 uppercase font-semibold rounded border-[0.5px] border-white text-white bg-white/30 backdrop-blur-sm">{{ __('Mendaftar') }}</button> --}}
            </div>
        </div>
        <div class="flex-1 bg-white/90 rounded-t-3xl p-3 overflow-y-scroll">
            <h3 class="text-center my-3 text-xl font-semibold ">Informasi</h3>
            <div class="flex flex-col items-center gap-3">
                @forelse ($announcement as $a)
                    <Link slideover href="{{ route('announcement.show', $a->id) }}"
                        class="cursor-pointer w-full p-3 bg-indigo-100 border border-indigo-200 h-26 rounded-lg overflow-y-hidden">
                    <div class="flex justify-between mb-2">
                        <h3 class="font-semibold">{{ $a->title }}</h3>
                        <h3 class="font-semibold text-slate-500">
                            {{ \Carbon\Carbon::parse($a->created_at)->translatedFormat('d/m/Y') }}</h3>
                    </div>
                    <p class="text-base line-clamp-2">{!! $a->body !!}</p>
                    </Link>
                @empty
                    <div class="flex flex-col items-center justify-center">
                        <lottie-player src="https://lottie.host/3f8b3436-c8da-470b-870f-689034f06127/8XAJ7BgN1z.json"
                            background="" speed="1" style="width: 300px; height: 300px" loop autoplay
                            direction="1" mode="normal"></lottie-player>
                        Belum Ada Informasi
                    </div>
                @endforelse
            </div>
        </div>
    </div>


    <div class="hidden sm:flex relative min-h-screen bg-gray-100 bg-center  justify-center items-center bg-dots-darker selection:bg-red-500 selection:text-white "
        style="background-image: url('{{ asset('bg/' . env('CURRENT_BACKGROUND') . '.jpg') }}'); background-size:cover; background-position: 25% 75%">
        <div class="p-6 mx-auto rounded-lg max-w-7xl lg:p-8 bg-black/20 backdrop-blur-md border border-slate-50/40">
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
                            class="font-semibold  hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 text-white dark:text-gray-600">
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
