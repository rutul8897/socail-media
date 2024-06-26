<div>
    <main class="flex justify-center items-center gap-6 my-5 w-full container mx-auto">
        <div class="w-3/6">
        <article class="">
            <form class="bg-white shadow rounded-lg mb-6 p-4" wire:submit.prevent="savePost">
                <textarea name="message" placeholder="Type something..." class="w-full rounded-lg p-2 text-sm bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400" wire:model.live.blur="caption"></textarea>
                <span class="text-red-500">@error('caption') {{ $message }} @enderror</span>
                <footer class="flex justify-between mt-2">
                    <div>
                        <div class="flex gap-2">
                            <label for="photos" class="flex items-center transition ease-out duration-300 hover:bg-blue-500 hover:text-white bg-blue-100  px-2 rounded-full text-blue-400 cursor-pointer">
                                <div class="flex flex-col items-center justify-center pt-2 pb-2">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                </div>
                                <input id="photos" multiple wire:model.live="photos" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @if ($photos)
                        <div class="flex flex-row pt-2">
                            @foreach($photos as $photo)
                            <div class="px-2">
                                <img src="{{ $photo->temporaryUrl() }}" width="300px" height="300px">
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @error('photos') <span class="text-red-500">{{ $message }}</span> @enderror
                        @error('photos.*') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <button class="flex items-center py-2 px-4 rounded-lg text-sm bg-blue-600 text-white shadow-lg">Send
                            <svg class="ml-1" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </div>
                </footer>
            </form>
            <livewire:portal.post-liked-users />

             <div class=" bg-white shadow rounded-lg mb-6 p-4">
                <input type="text" wire:model.live="searchTerm" class="bg-gray-100 rounded-lg border border-transparent p-3 w-full" placeholder="Search somthing..." style="min-width:400px;">
                @if($searchTerm)<span class="pt-3">Search for {{ $searchTerm }}</span>@endif
            </div>

            @forelse($posts as $post)
            {{-- <livewire:portal.post-liked-users wire:key="like.{{$post->id}}"  :postId="$post->id" /> --}}
            <div class="bg-white shadow rounded-lg mb-6" wire:key="post.{{$post->id}}">
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
                    <div class="grid grid-cols-1 gap-1 items-center justify-center">
                        @foreach ($post->postImages as $postImage)
                        <div class="flex overflow-hidden rounded-xl max-h-[45rem] max-w-[45rem]">
                            <img class="object-cover h-full w-full" src="{{ asset('storage/') . '/' . $postImage->image }}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-gray-500 text-sm mb-6 mx-3 px-2">{{ $post->caption }}</div>
                <div class="flex justify-start mb-4 border-t border-gray-100">
                    <div class="flex w-full mt-1 pt-2 pl-5">
                       {{--  <span class="bg-white transition ease-out duration-300 hover:text-red-500 border px-2 pt-2 text-center rounded-full text-gray-400 cursor-pointer mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                        </span> --}}
                        <!-- Modal toggle -->
                        <button wire:click="$dispatch('showLikedUsers', { postId : {{$post->id}} })" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                          Show all likes
                        </button>
                       {{--  <img class="inline-block object-cover w-10 h-10 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                        <img class="inline-block object-cover w-10 h-10 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                        <img class="inline-block object-cover w-10 h-10 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80" alt="">
                        <img class="inline-block object-cover w-10 h-10 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2.25&amp;w=256&amp;h=256&amp;q=80" alt=""> --}}
                    </div>
                    <div class="flex justify-end w-full mt-1 pt-2 pr-5">
                        <span class="transition ease-out duration-300 hover:bg-gray-50 bg-gray-100 w-10 h-10 py-2 px-2 text-center rounded-full text-gray-100 cursor-pointer" wire:click="postLikeDislike({{ $post->id }})">
                            <svg class="h-6 w-6 text-red-500" fill="{{ $post->hasUserLikePost($post->id) ? 'red' : 'none' }}"  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                            </svg>
                        </span>
                       {{--  <span class="transition ease-out duration-300 hover:bg-gray-50 bg-gray-100 w-10 h-10 px-2 py-2 text-center rounded-full text-gray-400 cursor-pointer mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22px" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </span> --}}
                       {{--  <span class="transition ease-out duration-300 hover:bg-blue-50 bg-blue-100 w-10 h-10 px-2 py-2 text-center rounded-full text-blue-400 cursor-pointer mr-2">
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
                <livewire:portal.post-comments :$post :key="'comments.'.$post->id"/>
            </div>
            @empty
            <p>No Posts Found.</p>
            @endforelse
            <div x-intersect="$wire.loadMorePost()"></div>
        </article>
    </div>
     <!-- Main modal -->
{{-- <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Comments
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <ul>
                   <li>
                    <div class="text-black p-4 antialiased flex">
                        <img class="rounded-full h-9 w-9 mr-2 mt-1" src="">
                        <div class="w-full">
                            <div class="bg-gray-100 rounded-lg px-4 pt-2 pb-2.5">
                                <div class="font-semibold text-sm leading-relaxed">Rutul</div>
                                <div class="text-xs leading-snug md:leading-normal">2</div>
                            </div>
                            <div class="text-xs mt-0.5 text-gray-500">5 Mins ago</div>
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
            </ul>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="static-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div>
        </div>
    </div>
</div> --}}
    </main>
{{-- <section class="w-full flex justify-center mt-[50px] px-0 py-10">
<div class=" w-[70%] max-w-[1000px] grid grid-cols-[60%_40%] gap-[30px]">
<div class="flex flex-col">
// status wrappers
<section class="w-full flex justify-center mt-[50px] px-0 py-10">
<div class="w-[70%] max-w-[1000px] grid grid-cols-[60%_40%] gap-[30px]">
<div class="flex flex-col">
<div class="w-full h-[120px] border flex items-center overflow-hidden overflow-x-auto pr-0 p-2.5 rounded-sm border-solid border-[#dfdfdf]; background: #fff">
<div class="flex-[0_0_auto] w-20 max-w-[80px] flex flex-col items-center mr-[15px]">
<div class="w-[70px] h-[70px] overflow-hidden p-[3px] rounded-[50%]; background: linear-gradient(45deg, rgb(255, 230, 0), rgb(255, 0, 128) 80%)"><img src="https://dummyimage.com/50x50/000/fff&text=explore" class="w-full h-full object-cover rounded-[50%] border-2 border-solid border-white" alt=""></div>
<p class="w-full overflow-hidden text-center text-xs text-[rgba(0,0,0,0.5)] mt-[5px]">user_name_2</p>
</div>
<div class="flex-[0_0_auto] w-20 max-w-[80px] flex flex-col items-center mr-[15px]">
<div class="w-[70px] h-[70px] overflow-hidden p-[3px] rounded-[50%]; background: linear-gradient(45deg, rgb(255, 230, 0), rgb(255, 0, 128) 80%)"><img src="https://dummyimage.com/50x50/000/fff&text=explore" class="w-full h-full object-cover rounded-[50%] border-2 border-solid border-white" alt=""></div>
<p class="w-full overflow-hidden text-center text-xs text-[rgba(0,0,0,0.5)] mt-[5px]">user_name_2</p>
</div>
<div class="flex-[0_0_auto] w-20 max-w-[80px] flex flex-col items-center mr-[15px]">
<div class="w-[70px] h-[70px] overflow-hidden p-[3px] rounded-[50%]; background: linear-gradient(45deg, rgb(255, 230, 0), rgb(255, 0, 128) 80%)"><img src="https://dummyimage.com/50x50/000/fff&text=explore" class="w-full h-full object-cover rounded-[50%] border-2 border-solid border-white" alt=""></div>
<p class="w-full overflow-hidden text-center text-xs text-[rgba(0,0,0,0.5)] mt-[5px]">user_name_2</p>
</div>
<div class="flex-[0_0_auto] w-20 max-w-[80px] flex flex-col items-center mr-[15px]">
<div class="w-[70px] h-[70px] overflow-hidden p-[3px] rounded-[50%]; background: linear-gradient(45deg, rgb(255, 230, 0), rgb(255, 0, 128) 80%)"><img src="https://dummyimage.com/50x50/000/fff&text=explore" class="w-full h-full object-cover rounded-[50%] border-2 border-solid border-white" alt=""></div>
<p class="w-full overflow-hidden text-center text-xs text-[rgba(0,0,0,0.5)] mt-[5px]">user_name_2</p>
</div>
<div class="flex-[0_0_auto] w-20 max-w-[80px] flex flex-col items-center mr-[15px]">
<div class="w-[70px] h-[70px] overflow-hidden p-[3px] rounded-[50%]; background: linear-gradient(45deg, rgb(255, 230, 0), rgb(255, 0, 128) 80%)"><img src="https://dummyimage.com/50x50/000/fff&text=explore" class="w-full h-full object-cover rounded-[50%] border-2 border-solid border-white" alt=""></div>
<p class="w-full overflow-hidden text-center text-xs text-[rgba(0,0,0,0.5)] mt-[5px]">user_name_2</p>
</div>
</div>
</div>
</section>

<div class="w-full h-auto border mt-10 border-solid border-[#dfdfdf]">
<div class="w-full h-[60px] flex justify-between items-center px-5 py-0">
<div class="flex items-center">
<div class="h-10 w-10 p-0 bg-none"><img src="https://dummyimage.com/50x50/000/fff&text=explore" alt=""></div>
<p class="w-auto font-[bold] text-black text-sm ml-2.5">modern_web_channel</p>
</div>
<img src="https://dummyimage.com/50x50/000/fff&text=explore" class="h-2.5 cursor-pointer" alt="">
</div>
<img src="https://dummyimage.com/150x150/000/fff&text=explore" class="w-full h-[500px] object-cover" alt="">
<div class="w-full p-5">
<div class="w-full h-[50px] flex items-center -mt-5">
<img src="https://dummyimage.com/50x50/000/fff&text=like.PNG" class="h-[25px] mr-5 m-0" alt="">
<img src="https://dummyimage.com/50x50/000/fff&text=comment.PNG" class="h-[25px] mr-5 m-0" alt="">
<img src="https://dummyimage.com/50x50/000/fff&text=send.PNG" class="h-[25px] mr-5 m-0" alt="">
<img src="https://dummyimage.com/50x50/000/fff&text=save.PNG" class="ml-auto h-[25px] mr-5 m-0" alt="">
</div>
<p class="font-[bold]">1,012 likes</p>
<p class="text-sm leading-5 mx-0 my-2.5"><span class="font-[bold] mr-2.5">username </span> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur tenetur veritatis placeat, molestiae impedit aut provident eum quo natus molestias?</p>
<p class="text-[rgba(0,0,0,0.5)] text-xs">2 minutes ago</p>
</div>
<div class="w-full h-[50px] flex justify-between items-center rounded-[1px_solid_#dfdfdf]">
<img src="img/smile.PNG" class="h-[30px]" alt="">
<input type="text" class="w-4/5 h-full text-sm border-[none] outline-none" placeholder="Add a comment">
<button class="h-full capitalize text-base text-[rgb(0,162,255)] opacity-50 border-[none] bg-none outline-none">post</button>
</div>
</div>
// +5 more post elements
</div>
</div>
</section> --}}
</div>
@push('custom-scripts')
<script>
    function toggleReplyBox(button) {
        // Toggle visibility of the next sibling div (reply text box)
        const replyBox = button.nextElementSibling;
        replyBox.classList.toggle('hidden');
    }

    // document.addEventListener('livewire:load', function () {
    //     Livewire.on('open-comment-modal', function () {
    //         alert('Test Event Fired');
    //     });
    // });

    // Livewire.on('open-comment-modal',  function(post) {
    //      $('#static-modal').modal('show');
    // })
    //  window.addEventListener('open-comment-modal', function () {
    //     alert('hi');
    //     jQuery('#static-modal').modal('show');
    // });
    //

    Livewire.on('open-comment-modal', function (postId) {
        // Your logic to open the comment modal
        // alert('Open Comment Modal');
        // $('#static-modal').modal('show');
        const $targetEl = document.getElementById('modalEl');
        const options = {
          // placement: 'bottom-right',
          backdrop: 'static',
          // backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
          closable: false,
          // onHide: () => {
          //     console.log('modal is hidden');
          // },
          // onShow: () => {
          //     console.log('modal is shown');
          // },
          // onToggle: () => {
          //     console.log('modal has been toggled');
          // }
      };
        const modal = new Modal($targetEl,options);
        modal.show();

        // const closeModalButton = document.querySelector(".close-modal-"+postId);
        // closeModalButton.addEventListener('click', function() {
        //     modal.hide();
        // });
    });

     Livewire.on('close-comment-modal', function (postId) {
        const $targetEl = document.getElementById('modalEl');
         const modal = new Modal($targetEl);
        modal.hide();
    });
</script>
@endpush
