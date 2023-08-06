<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$student" :action="route('student.update', $student->id)" class="flex flex-col gap-4" method="put">
            <div class="grid sm:grid-cols-2 justify-center items-center gap-4">
                <div class="relative w-56">
                    @if (!$student->verified_at)
                        @can('approval students')
                            <div class="absolute bottom-0 left-2 flex justify-center my-3 gap-1">
                                <Link href="{{ route('student.verify', $student->nis) }}" confirm="Konfirmasi..."
                                    confirm-text="Akan diterima santri aktif?" confirm-button="Ya"
                                    cancel-button="Tidak, cek dulu"
                                    class="flex items-center justify-between py-1 lg:py-1 px-4 bg-white border-2 border-green-500 rounded-full text-green-600 hover:bg-green-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M225.86,102.82c-3.77-3.94-7.67-8-9.14-11.57-1.36-3.27-1.44-8.69-1.52-13.94-.15-9.76-.31-20.82-8-28.51s-18.75-7.85-28.51-8c-5.25-.08-10.67-.16-13.94-1.52-3.56-1.47-7.63-5.37-11.57-9.14C146.28,23.51,138.44,16,128,16s-18.27,7.51-25.18,14.14c-3.94,3.77-8,7.67-11.57,9.14C88,40.64,82.56,40.72,77.31,40.8c-9.76.15-20.82.31-28.51,8S41,67.55,40.8,77.31c-.08,5.25-.16,10.67-1.52,13.94-1.47,3.56-5.37,7.63-9.14,11.57C23.51,109.72,16,117.56,16,128s7.51,18.27,14.14,25.18c3.77,3.94,7.67,8,9.14,11.57,1.36,3.27,1.44,8.69,1.52,13.94.15,9.76.31,20.82,8,28.51s18.75,7.85,28.51,8c5.25.08,10.67.16,13.94,1.52,3.56,1.47,7.63,5.37,11.57,9.14C109.72,232.49,117.56,240,128,240s18.27-7.51,25.18-14.14c3.94-3.77,8-7.67,11.57-9.14,3.27-1.36,8.69-1.44,13.94-1.52,9.76-.15,20.82-.31,28.51-8s7.85-18.75,8-28.51c.08-5.25.16-10.67,1.52-13.94,1.47-3.56,5.37-7.63,9.14-11.57C232.49,146.28,240,138.44,240,128S232.49,109.73,225.86,102.82Zm-52.2,6.84-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32Z">
                                    </path>
                                </svg>
                                Verifikasi
                                </Link>
                            </div>
                        @endcan
                    @else
                        <div class="absolute top-0 right-2 flex justify-center my-3 gap-1">
                            <Link href="{{ route('student.verify', $student->nis) }}" confirm="Konfirmasi..."
                                confirm-text="Akan diterima santri aktif?" confirm-button="Ya"
                                cancel-button="Tidak, cek dulu"
                                class="flex items-center justify-between  rounded-full text-green-600 hover:bg-green-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bg-white rounded-full" viewBox="0 0 256 256">
                                <path
                                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm45.66,85.66-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32Z">
                                </path>
                            </svg> </Link>
                        </div>
                    @endif
                    <img class="rounded-xl object-cover w-full h-full"
                        src="{{ $student->student_image ? asset('storage/student-photos/' . $student->student_image) : asset('bakid/default_image.jpg') }}"
                        onerror="this.onerror=null;this.src='{{ asset('bakid/default-profile.png') }}';" />

                </div>
                <div class="grow">
                    <h3 class="text-xl">{{ $student->student_name }}</h3>
                    <h3 class="text-gray-500">{{ $student->nickname }}</h3>
                    <h3>{{ $student->district . ' - ' . $student->city }}</h3>
                    <h3>Asrama : {{ $student->dormitory_name . '-' . $student->room }}</h3>
                    <h3>Jumlah saudara : {{ $student->brothers_count }}</h3>
                    @hasrole('bendahara')
                        <div class="grid grid-cols-2 mt-3 gap-2 text-center">
                            <a href="{{ route('student.kts', $student->nis) }}"
                                class="p-3 border bg-green-500 hover:bg-green-600 rounded-xl text-white">
                                Riwayat tagihan
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-2 mt-3 gap-2 text-center">
                            <a href="{{ route('student.kts', $student->nis) }}"
                                class="p-3 border bg-green-500 hover:bg-green-600 rounded-xl text-white">
                                KTS
                            </a>
                            <a href="{{ route('student.k-mahrom', $student->nis) }}"
                                class="p-3 bordemr bg-green-500 hover:bg-green-600 rounded-xl text-white">
                                Kartu Mahrom
                            </a>
                            <a href="{{ route('student.pdf.mou', $student->nis) }}"
                                class="p-3 border border-slate-300 text-slate-600 hover:bg-green-200 rounded-xl">
                                MoU
                            </a>
                            <a href="{{ route('student.pdf.biodata', $student->nis) }}"
                                class="p-3 border border-slate-300 text-slate-600 hover:bg-green-200 rounded-xl">
                                Biodata
                            </a>
                        </div>
                    @endhasrole
                </div>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
