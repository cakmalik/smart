   <div class="flex flex-wrap gap-2">
                            @forelse ($i->rombel as $ri)
                                <div class=" grow flex justify-center card text-gray-500 border rounded-md border-gray-200 px-2 py-1 bg-white hover:bg-wa-teal1 hover:text-white cursor-pointer">
                                    {{ $ri->grade_name }}
                                </div>
                            @empty
                                <span class="flex grow justify-center text-gray-400">Tidak ditemukan
                                    Rombel</span>
                            @endforelse
                        </div>