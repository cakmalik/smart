 @props(['link' => route('dashboard')])
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
