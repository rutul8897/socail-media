<div>
    {{-- Do your work, then step back. --}}
      <!-- Main modal -->
      <div id="modalEl" wire:ignore.self tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                        Comments
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                     @foreach ($comments as $key => $postComment)
                    <ul>
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
            <ul class="pl-3">
                <livewire:portal.post-nested-comments :postComment="$postComment" :key="$postComment->id" />
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
   {{--  @include('livewire.portal.comment-form', [
        "method" => "postComment($post->id)",
        "inputName" => "comment",
        "inputId" => "comment",
        'userPhoto' => Auth::user()->photo
    ]) --}}
                </div>
            </div>
        </div>
    </div>
</div>
