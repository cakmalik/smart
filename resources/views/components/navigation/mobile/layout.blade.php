 <x-splade-toggle data="isShowMobileMenu">
     <x-splade-transition show="isShowMobileMenu" animation="slide-right">
         <div class="z-[100] fixed top-0 right-0 min-h-screen w-full bg-black/50 backdrop-blur-md">
             <div class="flex justify-end h-full">
                 <div class="w-4/5 bg-black/50 border-l border-white/30 min-h-screen">
                     <div class="w-full text-white">
                         <div class="p-5 border-b border-white/10">
                             <div class="flex items-end justify-start gap-2">
                                 <img src="{{ asset('bakid/logo-ppmu.png') }}" alt="Logo" class="w-8 h-8" />
                                 <span class=" text-2xl italic font-bold ">Bakid</span>
                             </div>
                         </div>
                     </div>
                     <div @click.prevent="setToggle('isShowMobileMenu',false)"
                         class="absolute bottom-5 right-5 w-10 h-10 cursor-pointer bg-wa-teal1 rounded-full flex items-center justify-center text-white text-sm">
                         <i class="ph-bold ph-x"></i>
                     </div>
                 </div>
             </div>
         </div>
     </x-splade-transition>
     <nav class="z-50 fixed bottom-0 w-full h-auto sm:hidden">
         <div class="flex justify-end  items-center w-full" v-if="!isShowMobileMenu">
             <div @click.prevent="setToggle('isShowMobileMenu',true)"
                 class="w-12 h-12 me-5 mb-5 cursor-pointer bg-wa-light rounded-full flex items-center justify-center text-white">
                 <i class="ph-bold ph-list"></i>
             </div>
         </div>

         <div class="bg-white shadow-lg">
             <div class="flex px-3 py-3">
                 <!-- 5 menu utama -->
                 <div class="grid grid-cols-4 w-full gap-1 text-xs">
                     <x-navigation.admin-menu-component name="{{ __('Dashboard') }}" icon="ph-house-line"
                         :active="request()->routeIs('dashboard')" />
                     <x-navigation.admin-menu-component name="{{ __('Announcement') }}" :link="route('student.index')"
                         icon="ph-broadcast" :active="request()->routeIs('annoucement')" />
                     <x-navigation.admin-menu-component name="{{ __('Search') }}" :link="route('student.index')"
                         icon="ph-magnifying-glass" :active="request()->routeIs('search')" />
                     <x-navigation.admin-menu-component name="Santri" :link="route('student.index')" icon="ph-user-circle"
                         :active="request()->routeIs('profile')" />
                 </div>
             </div>
         </div>
     </nav>
 </x-splade-toggle>
