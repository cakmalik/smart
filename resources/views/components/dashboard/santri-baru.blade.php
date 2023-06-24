    <div class="mx-auto max-w-5xl p-6 lg:p-8 border-b border-gray-200">
        <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center">
            Selangkah lagi
        </h1>
        <div class=" grid grid-col md:grid-cols-2 mt-4 text-center gap-3">
            <Link @if ($data['students']->isEmpty()) href="#"  @else href="#modalLembaga" @endif
                class="relative p-3 py-5 w-full @if ($data['students']->isEmpty()) bg-white/50 cursor-default  @else bg-green-400 @endif rounded-xl">
            @if ($data['students']->isEmpty())
                <div class="absolute right-2 top-2 p-1 rounded-full  bg-green-500"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ffffff"
                        viewBox="0 0 256 256">
                        <path
                            d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z">
                        </path>
                    </svg>
                </div>
            @endif
            <svg class="inline-flex justify-center" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                fill="#000000" viewBox="0 0 256 256">
                <path
                    d="M240,208H224V96a16,16,0,0,0-16-16H144V32a16,16,0,0,0-24.88-13.32L39.12,72A16,16,0,0,0,32,85.34V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM208,96V208H144V96ZM48,85.34,128,32V208H48ZM112,112v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm-32,0v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm0,56v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Zm32,0v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Z">
                </path>
            </svg>
            <h3 class="text-xl">Pilih lembaga pendidikan</h3>
            </Link>

            <Link @if ($data['studentsWithoutRooms']->isEmpty()) href="#"  @else href="#modalLembaga" @endif
                class="relative p-3 py-5 w-full @if ($data['studentsWithoutRooms']->isEmpty()) bg-white/50 cursor-default  @else bg-green-400 @endif rounded-xl">

            @if ($data['studentsWithoutRooms']->isEmpty())
                <div class="absolute right-2 top-2 p-1 rounded-full  bg-green-500"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ffffff"
                        viewBox="0 0 256 256">
                        <path
                            d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z">
                        </path>
                    </svg>
                </div>
            @endif
            <svg class="inline-flex justify-center" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                fill="#000000" viewBox="0 0 256 256">
                <path
                    d="M240,208H224V96a16,16,0,0,0-16-16H144V32a16,16,0,0,0-24.88-13.32L39.12,72A16,16,0,0,0,32,85.34V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM208,96V208H144V96ZM48,85.34,128,32V208H48ZM112,112v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm-32,0v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm0,56v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Zm32,0v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Z">
                </path>
            </svg>
            <h3 class="text-xl">Pilih asrama</h3>
            </Link>

            <Link class="p-3 py-5 w-full bg-green-400 rounded-xl">
            <svg class="inline-flex justify-center" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                fill="#000000" viewBox="0 0 256 256">
                <path
                    d="M224,48H32A16,16,0,0,0,16,64V192a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V64A16,16,0,0,0,224,48Zm0,16V88H32V64Zm0,128H32V104H224v88Zm-16-24a8,8,0,0,1-8,8H168a8,8,0,0,1,0-16h32A8,8,0,0,1,208,168Zm-64,0a8,8,0,0,1-8,8H120a8,8,0,0,1,0-16h16A8,8,0,0,1,144,168Z">
                </path>
            </svg>
            <h3 class="text-xl">Selesaikan pembayaran</h3>
            </Link>
        </div>

        <x-splade-modal name="modalLembaga">
            <x-splade-form :action="route('student.complete-education')" stay background reset-on-success @success="$splade.emit('done-admission')">
                <x-splade-select class="mb-3 mt-5" :options="$data['students']" option-label="name" option-value="id"
                    name="student_id" placeholder="{{ __('Pilih Putra/i') }}" choices="{ searchEnabled: false }" />
                <x-splade-select class="mb-3" :options="$data['formal']" option-label="name" option-value="id" name="formal_id"
                    placeholder="{{ __('Formal') }}" />
                <x-splade-select class="mb-3" remote-url="`/api/formal_classes/${form.formal_id}`"
                    option-label="class_name" option-value="id" name="formal_class_id"
                    placeholder="{{ __('Pilih Kelas') }}" />

                <x-splade-select class="mb-3" :options="$data['informal']" option-label="name" option-value="id"
                    name="informal_id" placeholder="{{ __('Informal') }}" />
                <x-splade-select class="mb-3" remote-url="`/api/informal_classes/${form.informal_id}`"
                    option-label="class_name" option-value="id" name="informal_class_id"
                    placeholder="{{ __('Pilih Kelas') }}" />

                <div class="flex justify-end">
                    <x-splade-submit>
                        Kirim Pengajuan
                    </x-splade-submit>
                </div>
                {{-- <Counter :formal="@js($data['formal'])" /> --}}
            </x-splade-form>
        </x-splade-modal>


        <x-splade-modal name="modalAsrama">
            <x-splade-form :action="route('student.complete-room')" stay background reset-on-success @success="$splade.emit('done-admission')">
                <x-splade-select class="mb-3 mt-5" :options="$data['studentsWithoutRooms']" option-label="name" option-value="id"
                    name="student_id" placeholder="{{ __('Pilih Putra/i') }}" choices="{ searchEnabled: false }" />

                <x-splade-select class="mb-3" remote-url="`/api/dormitories/by-student-gender/${form.student_id}`"
                    option-label="name" option-value="id" name="dormitory_id" placeholder="{{ __('Pilih Daerah') }}" />

                <x-splade-select class="mb-3" remote-url="`/api/rooms/by-dormitory/${form.dormitory_id}`"
                    option-label="name" option-value="id" name="room_id" placeholder="{{ __('Pilih Asrama') }}" />


                <div class="flex justify-end">
                    <x-splade-submit>
                        Kirim Pengajuan
                    </x-splade-submit>
                </div>
                {{-- <Counter :formal="@js($data['formal'])" /> --}}
            </x-splade-form>
        </x-splade-modal>

    </div>
