<div class="mx-auto max-w-xl p-6 lg:p-8 border-b border-gray-200 bg-white/50 backdrop-blur-sm sm:rounded-lg">
    <div class="flex justify-center">
        <x-application-logo class="block h-12 w-auto mx-auto" />
    </div>
    @if (auth()->user()->students->count() == 0 &&
            !auth()->user()->isAdmin())
        <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center">
            Assalamualaikum, {{ Auth::user()->name }}'s Family
        </h1>
        @if (isCanAdmission())
            <p class="mt-6 text-gray-700 leading-relaxed text-center">
                kami informasikan bahwa satu akun orang tua bisa memiliki/memantau
                semua anggota keluarga yang terdaftar sebagai santri di pesantren kami.
            </p>
        @else
            <p class="mt-3 text-center text-lg bg-yellow-300">Mohon Maaf, Pendaftaran Santri Baru Belum dibuka.
            </p>
            <p class="text-center"> Klik link dibawah ini agar
                diingatkan secara otomatis
                melalui WA jika pendaftaran telah dibuka. </p>
            @php
                $userId = auth()->user()->id;
            @endphp
            <x-splade-link :href="route('reminder.registration')" method="POST" :data="['user_id' => $userId, 'for' => 'registration']" background
                class="flex justify-center mt-6 p-4 px-6 bg-green-600 rounded-xl text-white hover:bg-green-700 "
                preserve-scroll>
                <span class="font-semibold">INGATKAN</span>
            </x-splade-link>
        @endif
    @else
        'asdasd'
    @endif


    @if (isHasStudents() == 0 &&
            !auth()->user()->isAdmin() &&
            isCanAdmission())

        <div>
            <h2 class="ml-3 text-xl font-semibold text-gray-900 text-center mt-5">
                <a href="{{ route('student.create') }}">Daftarkan Sekarang</a>
            </h2>

            <p class="mt-4 text-gray-900 text-base leading-relaxed text-center">
                @if (isHasStudents() == 0)
                    Anda terdeteksi belum mendaftarkan putra/putri anda sebagai santri di pesantren kami, silahkan
                    daftarkan
                @endif
            </p>


            <p class="mt-4 text-base text-center">
                <Link href="{{ route('student.create') }}"
                    class="inline-flex items-center font-semibold text-white px-10 py-3 rounded-full bg-green-500 animate-pulse">
                Mendaftar

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-white">
                    <path fill-rule="evenodd"
                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                        clip-rule="evenodd" />
                </svg>
                </Link>
            </p>
        </div>
    @endif

</div>
