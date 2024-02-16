
<x-menu.web :mega="false" link="{{ route('dashboard') }}" label="Home" />
<x-menu.web :mega="true" link="{{ route('dashboard') }}" label="Home">
    <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
        <ul class="space-y-4">
            <x-menu.web :mega="false" link="{{ route('user.index') }}" label="Home" icon="ph-airplane"/>
        </ul>
    </div>
    <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
        <ul class="space-y-4">
           
        </ul>
    </div>
    <div class="p-4 text-gray-900 dark:text-white">
        <ul class="space-y-4">
        </ul>
    </div>
</x-menu.web>

<li>
    <a href="#"
        class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">Team</a>
</li>
