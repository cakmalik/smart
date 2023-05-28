 <ol class="flex justify-center items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 my-5">
     <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5"
         :class="{ 'text-blue-500 dark:text-blue-400': data.currentIndex === 0 }">
         <span class="flex items-center justify-center w-8 h-8 border  rounded-full shrink-0 "
             :class="{ 'border-blue-600 dark:border-blue-500': data.currentIndex === 0 }">
             1
         </span>
         <span>
             <h3 class="font-medium leading-tight">User info</h3>
         </span>
     </li>
     <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5"
         :class="{ 'text-blue-500 dark:text-blue-400': data.currentIndex === 1 }">
         <span class="flex items-center justify-center w-8 h-8 border  rounded-full shrink-0 "
             :class="{ 'border-blue-600 dark:border-blue-500': data.currentIndex === 1 }">
             1
         </span>
         <span>
             <h3 class="font-medium leading-tight">User info</h3>
         </span>
     </li>
     <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5"
         :class="{ 'text-blue-500 dark:text-blue-400': data.currentIndex === 2 }">
         <span class="flex items-center justify-center w-8 h-8 border  rounded-full shrink-0 "
             :class="{ 'border-blue-600 dark:border-blue-500': data.currentIndex === 2 }">
             1
         </span>
         <span>
             <h3 class="font-medium leading-tight">User info</h3>
         </span>
     </li>

 </ol>
