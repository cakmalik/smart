 @props(['link' => '#', 'is_highlight' => false, 'submenu' => false])
 {{-- BOTTOM --}}
 @if ($is_highlight)
     <Link class="w-full" href="{{ $link }}">
     <div class="flex flex-col items-center justify-between">
         <div class="w-2/3">
             <div
                 class="rounded-full flex justify-center items-center bg-white @if ($active) bg-gray-200 @endif">
                 <i class="text-xl ph @if ($active) ph-fill @endif {{ $icon }}"></i>
             </div>
         </div>
         <span @class(['font-bold ' => $active])>{{ $name }}</span>
     </div>
     </Link>
 @else
     {{-- SIDEBAR --}}
     @if ($submenu == false)
         <Link href="{{ $link }}" class="flex w-full ">
         <div class="flex">
             <div class=" py-1 px-1 rounded-full @if ($active) bg-slate-600 @endif">
                 <div class="flex items-center gap-2 justify-normal px-2">
                     <i class="ph @if ($active) ph-fill @endif {{ $icon }} "
                         style="font-size: 20px"></i>
                     <span>{{ $name }}</span>
                 </div>
             </div>
         </div>
         </Link>
     @else
         <div class="flex">
             <x-splade-toggle>
                 <div class="flex flex-col cursor-pointer" @click.prevent="toggle">
                     <div class=" py-1 px-1 rounded-full @if ($active) bg-slate-600 @endif">
                         <div class="flex items-center gap-2 justify-start px-2">
                             <i class="ph @if ($active) ph-fill @endif {{ $icon }}"
                                 style="font-size: 20px"></i>
                             <span>{{ $name }}</span>
                         </div>
                     </div>
                     <div class=" flex flex-col w-full gap-2 ps-10" v-show="toggled">
                         @foreach ($submenu as $sm)
                             <Link href="{{ $sm['link'] }}">
                             {{ $sm['name'] }}
                             </Link>
                         @endforeach
                     </div>
                 </div>
             </x-splade-toggle>
         </div>
     @endif
 @endif
