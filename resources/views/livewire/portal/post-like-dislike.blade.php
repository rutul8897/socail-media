{{-- <div> --}}
    <span class="transition ease-out duration-300 hover:bg-gray-50 bg-gray-100 w-10 h-10 py-2 px-2 text-center rounded-full text-gray-100 cursor-pointer" wire:click="postLikeDislike()">
        <svg class="h-6 w-6 text-red-500" fill="{{ $isLiked ? 'red' : 'none' }}"  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
        </svg>
    </span>
{{-- </div> --}}
