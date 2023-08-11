 <x-splade-toggle data="isShowMobileMenu">
     <x-splade-transition show="isShowMobileMenu" animation="slide-right">
         <div class="z-[51] fixed top-0 right-0 min-h-screen w-full bg-black/50 backdrop-blur-md">
             <div class="flex justify-end h-full">
                 <div class="w-4/5 bg-black/50 border-l border-white/30 min-h-screen">
                     <div class="flex flex-col justify-between w-full h-full text-white">
                         <div class="grow w-full bg-red-900">
                             {{-- bagian header dan profile  --}}
                             <div class="">
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
                                             src="{{ auth()->user()->profile_photo_url }}"
                                             alt="{{ auth()->user()->name }}">
                                     </button>
                                     <div class="flex flex-col gap-0">
                                         <span class="font-semibold capitalize">{{ auth()->user()->name }}</span>
                                         <span class="text-sm">{{ auth()->user()->email }}</span>
                                     </div>
                                 </div>
                             </div>
                             {{-- bagian menu --}}
                             <div class="h-60 p-2 space-y-1 overflow-y-scroll">
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                                 <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                                     :link="route('dashboard')" :active="request()->routeIs('dashboard')" />
                                 <x-navigation.admin-menu-component name="{{ __('Students') }}" icon="ph-house-line"
                                     :link="route('student.index')" :active="request()->routeIs('student.index')" />
                             </div>
                         </div>
                         {{-- bagian footer --}}
                         <div class="h-12 w-full p-4 mb-4 flex justify-between bg-black/50 items-center">
                             <Link class="flex gap-1 items-center justify-start p-2 pe-6" confirm="Apakah yakin keluar?"
                                 confirm-button="Ya!" cancel-button="Tidak" href="{{ route('logout') }}" method="post"
                                 @click.prevent="setToggle('isShowMobileMenu',false)">
                             <i class="ph-fill ph-sign-out"></i>
                             <span>Keluar</span>
                             </Link>
                             <div @click.prevent="setToggle('isShowMobileMenu',false)"
                                 class="w-10 h-10 cursor-pointer bg-wa-teal1 rounded-full flex items-center justify-center text-white text-sm">
                                 <i class="ph-bold ph-x"></i>
                             </div>
                         </div>
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
                         :link="route('student.index')" icon="ph-magnifying-glass" :active="request()->routeIs('search')" />
                     <x-navigation.admin-menu-component :is_highlight="true" name="Santri" :link="route('student.index')"
                         icon="ph-user-circle" :active="request()->routeIs('profile')" />
                 </div>
             </div>
         </div>
     </nav>
 </x-splade-toggle>
