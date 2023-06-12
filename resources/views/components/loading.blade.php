<div class="fixed inset-0 flex items-center justify-center z-50"  v-if="form.processing">
    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    <div class="relative z-10 p-4 bg-white rounded-lg shadow-lg">
        <!-- Isi konten loading di sini -->
        <div class="flex items-center justify-center mb-4">
            <svg class="animate-spin h-8 w-8 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM12 20c3.042 0 5.824-1.135 7.938-3l-2.646-3A7.962 7.962 0 0112 16v4zm5.291-5.291l-3 2.647A7.962 7.962 0 0112 20V16c2.206 0 4-1.794 4-4h4c0 3.042-1.135 5.824-3 7.938z">
                </path>
            </svg>
        </div>
        <p class="text-center text-gray-800">Loading...</p>
    </div>
</div>
