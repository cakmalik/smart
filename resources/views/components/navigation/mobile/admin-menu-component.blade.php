 @props(['link' => route('dashboard'), 'is_highlight' => false])
 @if ($is_highlight)
     <Link class="w-full h-12" href="{{ $link }}">
     <div class="flex flex-col gap-1 items-center justify-between ">
         <div class="w-2/3">
             <div class="rounded-full flex justify-center items-center py-1" @class(['bg-gray-200' => $active])>
                 <i class="ph-fill {{ $icon }}"></i>
             </div>
         </div>
         <span @class(['font-bold ' => $active])>{{ $name }}</span>
     </div>
     </Link>
 @else
     <Link href="{{ $link }}" class="flex">
     <div class="py-1 px-1 rounded-full" @class(['bg-slate-600' => $active])>
         <div class="flex items-center gap-2 justify-normal px-2">
             <i class="ph {{ $icon }}" @class(['ph-fill' => $active]) style="font-size: 20px"></i>
             <span>{{ $name }}</span>
         </div>
     </div>
     </Link>
 @endif
