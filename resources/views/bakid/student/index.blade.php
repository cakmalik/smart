@seoTitle(__('Students'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('bakid.t.students') }}
        </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- component -->
                <section class="container px-4 mx-auto">
                    <div class="sm:flex sm:items-center sm:justify-between">
                    </div>

                    <x-splade-form action="/student" method="get" background :default="['search' => Request::get('search'), 'dormitory_id' => Request::get('dormitory_id')]">
                        <div class="mt-6 md:flex md:items-center md:justify-between">
                            <div
                                class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
                                <button
                                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-gray-100 sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                                    View all
                                </button>

                                {{-- <button
                                class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                                Monitored
                            </button>
                            
                            <button
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                            Unmonitored
                        </button> --}}
                            </div>



                            <div class="relative flex gap-2 items-center mt-4 md:mt-0">
                                <span class="absolute">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </span>
                                <div class="w-30">
                                    <x-splade-select v-model="form.dormitory_id" :options="$dormitories" option-label="name"
                                        option-value="id" placeholder="Filter Daerah" class="w-30" />
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" placeholder="Search"
                                        class="block w-full py-1.5 pr-1 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-52 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 "
                                        v-model="form.search">
                                    <button type="submit"
                                        class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-gray-100 sm:text-sm dark:bg-gray-800 dark:text-gray-300 rounded-lg">
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </x-splade-form>

                    <div class="flex flex-col mt-6">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    <button class="flex items-center gap-x-3 focus:outline-none">
                                                        <span>Nama</span>

                                                        <svg class="h-3" viewBox="0 0 10 11" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z"
                                                                fill="currentColor" stroke="currentColor"
                                                                stroke-width="0.1" />
                                                            <path
                                                                d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z"
                                                                fill="currentColor" stroke="currentColor"
                                                                stroke-width="0.1" />
                                                            <path
                                                                d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z"
                                                                fill="currentColor" stroke="currentColor"
                                                                stroke-width="0.3" />
                                                        </svg>
                                                    </button>
                                                </th>

                                                <th scope="col"
                                                    class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Daerah
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Alamat
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Keluarga</th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Phone</th>

                                                <th scope="col" class="relative py-3.5 px-4">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                            @forelse ($students as $i)
                                                <tr>
                                                    <td
                                                        class="px-4 py-4 text-sm font-medium whitespace-nowrap flex gap-3">
                                                        <img src="{{ asset('storage/student-photos/' . $i->image) }}"
                                                            onerror="this.onerror=null;this.src='{{ asset('bakid/default-profile.png') }}';"
                                                            class="w-10 h-10 rounded-full object-cover">
                                                        <div>

                                                            <h2
                                                                class="font-medium text-gray-800 dark:text-white capitalize ">
                                                                {{ $i->student_name }}
                                                            </h2>
                                                            <p
                                                                class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                                {{ $i->nickname }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                        <div
                                                            class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                            {{ $i->dormitory_name . '-' . $i->room }}
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                        <div>
                                                            <h4 class="text-gray-700 dark:text-gray-200">
                                                                {{ $i->city }}</h4>
                                                            <p class="text-gray-500 dark:text-gray-400">
                                                                {{ $i->city }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            {{ $i->ayah }}
                                                        </div>
                                                    </td>

                                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            {{ $i->phone }}
                                                        </div>
                                                    </td>

                                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex gap-1 ">
                                                                <Link modal href="{{ route('student.show', $i->id) }}"
                                                                    class="rounded-full p-1 bg-slate-500 text-white hover:bg-green-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-5 h-5 p-1">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                                                                </svg>

                                                                </Link>
                                                                <Link href="{{ route('student.edit', $i->id) }}"
                                                                    class="rounded-full p-1 bg-slate-500 text-white hover:bg-green-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-5 h-5 p-1">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                </svg>
                                                                </Link>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:flex sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Page <span
                                class="font-medium text-gray-700 dark:text-gray-100">{{ $students->currentPage() }} of
                                {{ $students->lastPage() }}</span>
                        </div>

                        <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
                            @if ($students->previousPageUrl())
                                <Link href="{{ $students->previousPageUrl() }}"
                                    class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                </svg>
                                <span>
                                    previous
                                </span>
                                </Link>
                            @endif

                            @if ($students->nextPageUrl())
                                <Link href="{{ $students->nextPageUrl() }}"
                                    class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                                <span>
                                    Next
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                                </Link>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
</x-app-layout>
