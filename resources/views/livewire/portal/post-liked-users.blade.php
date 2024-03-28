<div>
    {{-- @if($postId) --}}
    <div id="modalEl" wire:ignore.self tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                        People who have liked this post.
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" wire:click="hideLikeModal('{{ $postId }}')">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    @forelse ($likedUsers as $key => $likedUser)
                    <div class="pt--10 pr-0 pb-2 pl-0">
                        <div class="pt-5 pr-0 pb-0 pl-0 mt-5 mr-0 mb-0 ml-0">
                            <div class="sm:flex sm:items-center sm:justify-between sm:space-x-5">
                                <div class="flex items-center flex-1 min-w-0">
                                    <img src="https://miro.medium.com/max/512/1*n81Kr3UGUVsF0LLRgRQrJw.jpeg" class="flex-shrink-0
                                    object-cover rounded-full btn- w-10 h-10"/>
                                    <div class="mt-0 mr-0 mb-0 ml-4 flex-1 min-w-0">
                                        <p class="text-lg font-bold text-gray-800 truncate">{{ $likedUser->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <p>No likes yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}
</div>
