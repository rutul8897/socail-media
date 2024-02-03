<form wire:submit.prevent="{{ $method }}">
    <div class="relative flex items-center self-center w-full p-4 overflow-hidden text-gray-600 focus-within:text-gray-400">
        <img class="w-10 h-10 object-cover rounded-full shadow mr-2 cursor-pointer" alt="User avatar" src="{{ $userPhoto }}">
        <span class="absolute inset-y-0 right-0 flex items-center pr-6">
            <button type="submit" class="p-1 focus:outline-none focus:shadow-none hover:text-blue-500">
                <svg class="ml-1" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
            </button>
        </span>
        <input type="text" wire:model="{{$inputName}}" id="{{$inputId}}" class="w-full py-2 pl-4 pr-10 text-sm bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400" style="border-radius: 25px" placeholder="Post a comment..." autocomplete="off">
    </div>
    @error("$inputName")<div class="error pl-20 pb-2"><span class="text-red-500">{{ $message }}</span></div>@enderror
</form>