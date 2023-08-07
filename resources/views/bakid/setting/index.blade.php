@seoTitle(__('Settings'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('Settings') }}
        </h2>
        </x-slot>

        <div class="py-12">
            <x-splade-form action="{{ route('setting.store') }}" :default="$data" submit-on-change="api_key_whatsapp,"
                background debounce="2000" stay @success="$splade.emit('setting-updated')">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-yellow-300 px-3 py-3 rounded-lg mb-3 ">
                        Perhatian! ini auto save, jangan mengubah apapun jika tidak yakin dan mengerti fungsinya
                    </div>

                    <Link class="fixed bottom-4 right-4" href="#test">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded shadow">Tes Fungsi</button>
                    </Link>
                    <x-splade-modal name="test" slideover max-width="lg">
                        {{-- <div>
                            <Link href="{{ route('test.wa') }}">Tes Wa </Link> <span
                                class="w-10 h-10 bg-red-500 rounded-full p-1 text-sm">On</span>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Tes</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>

                                    </td>
                                    <td>
                                        <span class="w-10 h-10 bg-red-500 rounded-full p-1 text-sm">On</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}
                        <!-- component -->
                        <section class="container mx-auto p-6 font-mono">
                            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full">
                                        <thead>
                                            <tr
                                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                                <th class="px-4 py-3">Check</th>
                                                {{-- <th class="px-4 py-3">Status</th> --}}

                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            <tr class="text-gray-700">
                                                <ul>
                                                    <li>
                                                        <Link href="{{ route('test.wa') }}" @click="modal.close"
                                                            class="block w-full p-3 bg-green-300">
                                                        Tes Wa
                                                        </Link>
                                                    </li>
                                                </ul>

                                                {{-- <td class="px-4 py-3 text-xs border">
                                                    <span
                                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                        Acceptable </span>
                                                </td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </section>
                        <section class="container mx-auto p-6 font-mono">
                            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full">
                                        <thead>
                                            <tr
                                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                                <th class="px-4 py-3">Dokumentasi dan Link</th>
                                                {{-- <th class="px-4 py-3">Status</th> --}}

                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            <tr class="text-gray-700">
                                                <ul>
                                                    <li>
                                                        <a href="https://textmebot.com/" target="_blank"
                                                            class="block w-full p-3 bg-green-300">
                                                            Api key whatsapp
                                                        </a>
                                                    </li>
                                                </ul>

                                                {{-- <td class="px-4 py-3 text-xs border">
                                                    <span
                                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                        Acceptable </span>
                                                </td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </section>
                    </x-splade-modal>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @forelse ($data as $key => $value)
                            <div class="p-4 py-6 bg-white/50 border-white border-2 w-full rounded-lg">
                                {{ $key }}
                                <x-splade-input name="{{ $key }}" class="mt-3" />
                            </div>
                        @empty
                        @endforelse
                        <div class="p-4 py-6 bg-white/50 border-white border-2 w-full rounded-lg">
                            {{ __('Setting Format Message') }}
                            <Link href="{{ route('format-message.index') }}">
                            <button class="px-4 py-2 w-full bg-indigo-600 text-white rounded shadow mt-3">Edit</button>
                            </Link>
                        </div>
                        <div class="p-4 py-6 bg-white/50 border-white border-2 w-full rounded-lg">
                            {{ __('Change background') }}
                            <Link href="{{ route('setting.change-bg') }}">
                            <button
                                class="px-4 py-2 w-full bg-indigo-600 text-white rounded shadow mt-3">Switch</button>
                            </Link>
                        </div>
                    </div>
                </div>
            </x-splade-form>
        </div>
</x-app-layout>
