 @props(['link' => '#', 'variant' => 'small', 'color' => 'success', 'border' => false])
 <div class="px-4 sm:pl-0 pb-3">
     <Link href="" class="rounded-lg flex items-center justify-center gap-1" @class([
         'py-1 px-2 ' => $variant == 'sm',
         'py-2 px-4 ' => $variant == 'md',
         'bg-green-600 text-white hover:bg-green-700' =>
             $color == 'success' && $border == false,
         'bg-green-100 text-green-800 hover:bg-green-200 border border-green-600' =>
             $color == 'success' && $border == true,
         'bg-red-600 text-white hover:bg-red-700' =>
             $color == 'danger' && $border == false,
         'bg-red-100 text-red-800 hover:bg-red-200 border border-red-600' =>
             $color == 'danger' && $border == true,
     ])>
     {{ $slot }}
     </Link>
 </div>
