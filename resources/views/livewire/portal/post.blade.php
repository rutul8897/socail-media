<div>
      @forelse($posts as $post)
            <div class="bg-white shadow rounded-lg mb-6" >
                <div class="flex flex-row px-2 py-3 mx-3">
                    <div class="w-auto h-auto rounded-full">
                        <img class="w-12 h-12 object-cover rounded-full shadow cursor-pointer" alt="User avatar" src="{{ $post->user->photo }}">
                    </div>
                    <div class="flex flex-col mb-2 ml-4 mt-1">
                        <div class="text-gray-600 text-sm font-semibold">{{ $post->user->name }}</div>
                        <div class="flex w-full mt-1">
                            <div class="text-gray-400 font-thin text-xs">
                                • {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-b border-gray-100"></div>
                <div class="text-gray-400 font-medium text-sm mb-7 mt-6 mx-3 px-2">
                    <div class="grid grid-cols-2 gap-1 items-center justify-center">
                        @foreach ($post->postImages as $postImage)
                        <div class="flex overflow-hidden rounded-xl max-h-[45rem] max-w-[45rem]">
                            <img class="object-cover h-full w-full" src="{{ asset('storage/' . $postImage->image) }}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-gray-500 text-sm mb-6 mx-3 px-2">{{ $post->caption }}</div>
                <div class="flex justify-start mb-4 border-t border-gray-100">
                    {{-- <div class="flex w-full mt-1 pt-2 pl-5">
                        <span class="bg-white transition w-10 h-10 ease-out duration-300 hover:text-red-500 border px-2 pt-2 text-center rounded-full text-gray-400 cursor-pointer mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22px" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </span>
                        <img class="inline-block object-cover w-10 h-10 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                        <img class="inline-block object-cover w-10 h-10 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                        <img class="inline-block object-cover w-10 h-10 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80" alt="">
                        <img class="inline-block object-cover w-10 h-10 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2.25&amp;w=256&amp;h=256&amp;q=80" alt="">
                    </div> --}}
                    <div class="flex justify-end w-full mt-1 pt-2 pr-5">
                        <span class="transition ease-out duration-300 hover:bg-gray-50 bg-gray-100 w-10 h-10 py-2 px-2 text-center rounded-full text-gray-100 cursor-pointer" wire:click="postLikeDislike({{ $post->id }})">
                            <svg class="h-6 w-6 text-red-500" fill="{{ $post->hasUserLikePost($post->id) ? 'red' : 'none' }}"  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                            </svg>
                        </span>
                        {{-- <span class="transition ease-out duration-300 hover:bg-blue-50 bg-blue-100 w-10 h-10 px-2 py-2 text-center rounded-full text-blue-400 cursor-pointer mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22px" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                        </span> --}}
                        {{-- <livewire:portal.post-like-dislike :postId="$post->id" :key="'postlike-'.$post->id" /> --}}
                    </div>
                </div>
                <div class="flex w-full border-t border-gray-100">
                    <div class="mt-3 mx-5 flex flex-row text-xs">
                        <div class="flex text-gray-700 font-normal rounded-md mb-2 mr-4 items-center">Comments:<div class="ml-1 text-gray-400 text-ms"> {{ $post->postComments->count() }}</div></div>
                    </div>
                    <div class="mt-3 mx-5 w-full flex justify-end text-xs">
                        <div class="flex text-gray-700  rounded-md mb-2 mr-4 items-center">Likes: <div class="ml-1 text-gray-400  text-ms"> {{ $post->postLikes->count() }}</div></div>
                    </div>
                </div>
                <livewire:portal.post-comments :$post :key="$post->id">
            </div>
            @empty
            <p>No Posts Found.</p>
            @endforelse
</div>
