 <x-splade-toggle data="isShowMobileMenu">
     <x-splade-transition show="isShowMobileMenu" animation="slide-right">
         <div class="z-[51] fixed min-h-screen w-full bg-black/50 backdrop-blur-md">
             <div
                 class="w-4/5 bg-black/50 border-l border-white/30 min-h-screen max-h-screen text-white ml-auto overflow-scroll flex flex-col">
                 {{-- bagian header dan profile  --}}
                 <div class="h-40">
                     <div class="px-3 py-5 border-b border-white/10">
                         <div class="flex items-end justify-start gap-2">
                             <img src="{{ asset('bakid/logo-ppmu.png') }}" alt="Logo" class="w-10 h-10" />
                             <span class=" text-3xl italic font-bold ">Bakid</span>
                         </div>
                     </div>
                     {{-- bagian profile --}}
                     <div
                         class="flex items-center justify-start gap-2 w-full p-4 border-y border-white/10 bg-slate-700/50">
                         <button
                             class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                             <img class="object-cover w-9 h-9 bg-green-400 rounded-full"
                                 src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                         </button>
                         <div class="flex flex-col gap-0">
                             <span class="font-semibold capitalize">{{ auth()->user()->name }}</span>
                             <span class="text-sm">{{ auth()->user()->email }}</span>
                         </div>
                     </div>
                 </div>
                 {{-- bagian menu --}}
                 <div class="flex-1  p-2 overflow-scroll">
                     <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                         :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                     <x-navigation.admin-menu-component name="{{ __('Announcement') }}" icon="ph-house-line"
                         :link="route('dashboard')" :active="request()->routeIs('announcement.index')" />
                     <x-navigation.admin-menu-component name="{{ __('Asrama') }}" icon="ph-house-line" link=""
                         :active="request()->routeIs('dormitory.index')" :submenu="[
                             ['name' => 'Asrama', 'link' => route('dormitory.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Non-Formal', 'link' => route('informal.index')],
                         ]" />
                     <x-navigation.admin-menu-component name="{{ __('Asrama') }}" icon="ph-house-line" link=""
                         :active="request()->routeIs('dormitory.index')" :submenu="[
                             ['name' => 'Asrama', 'link' => route('dormitory.index')],
                             ['name' => 'Formal', 'link' => route('formal.index')],
                             ['name' => 'Non-Formal', 'link' => route('informal.index')],
                         ]" />
                     {{-- <x-splade-dropdown>
                         <x-slot:trigger>
                             <div class="flex w-full cursor-pointer">
                                 <div class="py-1 px-1 rounded-full">
                                     <div class="flex items-center gap-2 justify-normal px-2">
                                         <i class="ph-fill ph-house" style="font-size: 20px"></i>
                                         <span>as</span>
                                     </div>
                                 </div>
                         </x-slot:trigger>
                         <div class=" bottom-0 flex bg-red-400 w-32 h-auto">
                             df
                         </div>
                 </div>
                 </x-splade-dropdown> --}}


             </div>
             {{-- bagian footer --}}
             <div class="h-20 relative bottom-0 w-full">
                 <div class="p-4 py-1 mb-4 bg-black/50 items-center">
                     <Link class="flex gap-1 items-center justify-start p-2 pe-6" confirm="Apakah yakin keluar?"
                         confirm-button="Ya!" cancel-button="Tidak" href="{{ route('logout') }}" method="post"
                         @click.prevent="setToggle('isShowMobileMenu',false)">
                     <i class="ph-fill ph-sign-out"></i>
                     <span>Keluar</span>
                     </Link>

                 </div>
                 <div @click.prevent="setToggle('isShowMobileMenu',false)"
                     class="absolute top-1 right-2 w-10 h-10 cursor-pointer bg-wa-teal1 rounded-full flex items-center justify-center text-white text-sm">
                     <i class="ph-bold ph-x"></i>
                 </div>
             </div>
         </div>
         </div>
     </x-splade-transition>
     <nav class="z-[29] fixed bottom-0 w-full h-auto sm:hidden">
         <div class="flex justify-end  items-center w-full" v-if="!isShowMobileMenu">
             <div @click.prevent="setToggle('isShowMobileMenu',true)"
                 class="w-12 h-12 me-5 mb-5 cursor-pointer bg-wa-light rounded-full flex items-center justify-center text-white">
                 <i class="ph-bold ph-list"></i>
             </div>
         </div>

         <div class="bg-white shadow-lg">
             <div class="flex px-3 py-3">
                 <!-- 4 menu utama -->
                 <div class="grid grid-cols-4 w-full gap-1 text-xs">
                     <x-navigation.admin-menu-component :is_highlight="true" name="{{ __('Dashboard') }}"
                         icon="ph-house-line" :active="request()->routeIs('dashboard')" />
                     <x-navigation.admin-menu-component :is_highlight="true" name="{{ __('Announcement') }}"
                         :link="route('student.index')" icon="ph-broadcast" :active="request()->routeIs('annoucement')" />
                     <x-navigation.admin-menu-component :is_highlight="true" name="{{ __('Search') }}"
                         :link="route('student.search')" icon="ph-magnifying-glass" :active="request()->routeIs('student.search')" />
                     <x-navigation.admin-menu-component :is_highlight="true" name="Santri" :link="route('student.index')"
                         icon="ph-user-circle" :active="request()->routeIs('profile')" />


                 </div>
             </div>
         </div>
     </nav>
 </x-splade-toggle>
