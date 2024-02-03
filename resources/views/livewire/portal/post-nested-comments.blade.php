<div>
    @foreach($nestedComments as $nestedComment)
    <li>
        <div class="text-black p-4 antialiased flex">
            <img class="rounded-full h-9 w-9 mr-2 mt-1" src="{{ $nestedComment->user->photo }}">
            <div class="w-full">
                <div class="bg-gray-100 rounded-lg px-4 pt-2 pb-2.5">
                    <div class="font-semibold text-sm leading-relaxed">{{ $nestedComment->user->name }}</div>
                    <div class="text-xs leading-snug md:leading-normal">{{ $nestedComment->comment }}</div>
                </div>
                <div class="text-xs mt-0.5 text-gray-500">{{ $nestedComment->created_at->diffForHumans() }}</div>
                <div class="bg-white border border-white rounded-full float-right -mt-8 mr-0.5 flex shadow items-center">
                    <!-- Like Button -->
                    <svg class="p-0.5 h-5 w-5 rounded-full z-20 bg-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <!-- ... (Your SVG Path for Like Button) ... -->
                    </svg>
                    <!-- Heart Button -->
                    <svg class="p-0.5 h-5 w-5 rounded-full -ml-1.5 bg-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <!-- ... (Your SVG Path for Heart Button) ... -->
                    </svg>
                    <span class="text-sm ml-1 pr-1.5 text-gray-500">3</span>
                </div>
            </div>
        </div>
    </li>
    @endforeach
    @if($totalNestedComments > $nestedPerPage)
    <div class="text-right">
        <button class="pr-4 text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="loadMoreNestedComments()">Load More Replies</button>
    </div>
    @endif
</div>
