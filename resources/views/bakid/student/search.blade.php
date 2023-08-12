<div class="bg-black text-white flex flex-col gap-4 items-center justify-center min-h-screen relative">

    <x-splade-form debounce="500" method="get" submit-on-change :default="['q' => Request('q')]">
        <input v-model="form.q" type="text" placeholder="{{ __('Search') }}" autofocus
            class="w-full px-4 py-2 text-center text-white focus:outline-none  focus:ring-0 bg-black focus:border-none border-none  text-2xl rounded-md shadow-sm ">

        <div class="grid grid-cols-3 gap-2 w-full px-4 overflow-hidden">
            @if (isset($students) && $students->count() > 0)
                @forelse ($students as $s)
                    <Link modal href="{{ route('student.show', $s->id) }}"
                        class="relative cursor-pointer bg-red-50 rounded-lg h-28 w-full overflow-hidden border-[0.5px] border-wite">
                    <div class=" w-full h-28">
                        <img src="{{ asset('bakid/bg-bakid.png') }}" class="w-full h-28 object-cover">
                    </div>
                    <div class="absolute bottom-0 text-center w-full bg-black/60 truncate p-1">
                        <p class="text-sm text-white truncate">{{ $s->nickname }}</p>
                        <span class="text-sm text-white truncate capitalize">{{ $s->name }}</span>
                    </div>
                    </Link>
                @empty
                    <div class="flex text-white bg-red-500">Tidak ditemukan</div>
                @endforelse
            @endisset
            {{-- <button type="submit">submit</button> --}}
    </div>
</x-splade-form>

<Link class="absolute top-0 right-0 text-gray-600 p-5" href="{{ route('student.index') }}">
<i class="ph-bold ph-x" style="font-size: 30px"></i>
</Link>
</div>
