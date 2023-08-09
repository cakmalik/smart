 @props(['link' => route('dashboard')])
 <Link class="w-full h-12" href="{{ $link }}">
 <div class="flex flex-col gap-1 items-center justify-between ">
     <div class="w-2/3">
         <div class="rounded-full flex justify-center items-center py-1">
             <i class="ph-fill {{ $icon }}"></i>
         </div>
     </div>
     @if ($active)
         <span class="font-bold ">{{ $name }}</span>
     @else
         <span>{{ $name }}</span>
     @endif
 </div>
 </Link>
