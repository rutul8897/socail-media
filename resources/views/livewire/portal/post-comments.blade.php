<div>
    {{-- Do your work, then step back. --}}
    @foreach ($comments as $key => $postComment)
    <ul wire:key="comment.{{$postComment->id}}">
        <li>
            <div class="text-black p-4 antialiased flex">
                <img class="rounded-full h-9 w-9 mr-2 mt-1" src="{{ $postComment->user->photo }}">
                <div class="w-full">
                    <div class="bg-gray-100 rounded-lg px-4 pt-2 pb-2.5">
                        <div class="font-semibold text-sm leading-relaxed">{{ $postComment->user->name }}</div>
                        <div class="text-xs leading-snug md:leading-normal">{{ $postComment->comment }}</div>
                    </div>
                    <div class="text-xs mt-0.5 text-gray-500">{{ $postComment->created_at->diffForHumans() }}</div>
                    {{-- <div class="bg-white border border-white rounded-full float-right -mt-8 mr-0.5 flex shadow items-center">
                        <!-- Like Button -->
                        <svg class="p-0.5 h-5 w-5 rounded-full z-20 bg-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                            <!-- ... (Your SVG Path for Like Button) ... -->
                        </svg>
                        <!-- Heart Button -->
                        <svg class="p-0.5 h-5 w-5 rounded-full -ml-1.5 bg-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                            <!-- ... (Your SVG Path for Heart Button) ... -->
                        </svg>
                        <span class="text-sm ml-1 pr-1.5 text-gray-500">3</span>
                    </div> --}}
                    <button class="text-sm mt-2 text-blue-500" onclick="toggleReplyBox(this)">Reply</button>

                    <!-- Reply Text Box (Initially Hidden) -->
                    <div class="hidden mt-1">
                        @include('livewire.portal.comment-form', [
                            "method" => "postComment($post->id, $postComment->id)",
                            "inputName" => "replyComment",
                            "inputId" => "reply-comment",
                            'userPhoto' => Auth::user()->photo
                        ])
                    </div>
                </div>
            </div>

            <!-- Nested Comments -->
            @if($postComment->nestedComments->count() > 0)
            {{-- <ul class="pl-3 max-h-40 overflow-y-scroll scrollbar scrollbar-thumb-gray-500 scrollbar-track-gray-200"> --}}
            <ul class="pl-3">
                <livewire:portal.post-nested-comments :postComment="$postComment" :key="$postComment->id" />
                    {{-- @foreach($postComment->nestedComments as $nestedComment)
                    <li>
                        <div class="text-black p-4 antialiased flex">
                            <img class="rounded-full h-9 w-9 mr-2 mt-1" src="{{ $nestedComment->user->photo }}">
                            <div class="w-full">
                                <div class="bg-gray-100 rounded-lg px-4 pt-2 pb-2.5">
                                    <div class="font-semibold text-sm leading-relaxed">{{ $nestedComment->user->name }}</div>
                                    <div class="text-xs leading-snug md:leading-normal">{{ $nestedComment->comment }}</div>
                                </div>
                                <div class="text-xs mt-0.5 text-gray-500">{{ $nestedComment->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </li>
                    @endforeach --}}
                </ul>
                @endif
        </li>
    </ul>
    @endforeach
    @if($totalParentComments > $perPage)
    <div class="text-center">
        <button class="pl-2 font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="loadMore()">Load More Comments</button>
        <button class="pl-2 font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="loadMore()">Hide Comments</button>
    </div>
    @endif
    @include('livewire.portal.comment-form', [
        "method" => "postComment($post->id)",
        "inputName" => "comment",
        "inputId" => "comment",
        'userPhoto' => Auth::user()->photo
    ])
</div>
