<div>
    <main class="gap-6 my-5 w-2xl container px-2 mx-auto">
        <div class="bg-white shadow rounded-lg mb-6">
            <header class="font-bold text-2xl px-5 py-4">
                Who to follow
            </header>
            <div class="shadow-xl mt-8 mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2" wire:scroll="loadMore">
                @foreach($users as $user)
                <div class="pt--10 pr-0 pb-2 pl-0">
                    <div class="pt-5 pr-0 pb-0 pl-0 mt-5 mr-0 mb-0 ml-0">
                        <div class="sm:flex sm:items-center sm:justify-between sm:space-x-5">
                            <div class="flex items-center flex-1 min-w-0">
                                <img src="https://miro.medium.com/max/512/1*n81Kr3UGUVsF0LLRgRQrJw.jpeg" class="flex-shrink-0
                                object-cover rounded-full btn- w-10 h-10"/>
                                <div class="mt-0 mr-0 mb-0 ml-4 flex-1 min-w-0">
                                    <p class="text-lg font-bold text-gray-800 truncate">{{ $user->name }}</p>
                                    <p class="text-gray-600 text-md">{{ $user->about }}</p>
                                </div>
                            </div>
                            <div class="mt-4 mr-0 mb-0 ml-0 pt-0 pr-0 pb-0 pl-14 flex items-center sm:space-x-6 sm:pl-0 sm:justify-end
                            sm:mt-0">
                        {{--     @php
                                $userId = $user->id
                            @endphp
                            @switch(true)
                            @case($user->hasFollowRequestFrom($userId))
                                <a href="javascript:;" wire:click="acceptFollowRequest({{$userId}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Accept</a>
                                <a href="javascript:;" wire:click="rejectFollowRequest({{$userId}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Reject</a>
                            @break

                            @case($user->hasAcceptedFollowRequestFrom($userId))
                                <a href="javascript:;" wire:click="followBack({{$userId}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Follow Back</a>
                            @break

                            @case($user->hasFollowBackFollowRequestFrom($userId))
                                <a href="#" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Following</a>
                            @break

                            @case($user->hasSentFollowRequest($userId) || $user->hasAcceptFollowRequest($userId))
                             <a href="#" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Requested</a>
                            @break

                            @case($user->hasReceivedFollowBackRequest($userId))
                                <a href="javascript:;" wire:click="acceptFollowRequest({{$userId}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Accept</a>
                                <a href="javascript:;" wire:click="rejectFollowRequest({{$userId}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Reject</a>
                            @break

                            @case($user->hasAcceptedFollowing($userId) || $user->hasAcceptedFollower($userId))
                                <a href="#" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Following</a>
                            @break

                            @default
                                <a href="javascript:;" wire:click="followUser({{$userId}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Follow</a>
                            @endswitch --}}
                            {{-- {{ dd($user) }} --}}
                           @if($user->hasFollowRequestFrom($user->id))
                                <a href="javascript:;" wire:click="acceptFollowRequest({{$user->id}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Accept</a>
                                <a href="javascript:;" wire:click="rejectFollowRequest({{$user->id}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Reject</a>
                            @elseif($user->hasAcceptedFollowRequestFrom($user->id))
                                <a href="javascript:;" wire:click="followBack({{$user->id}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Follow Back</a>
                            @elseif($user->hasFollowBackFollowRequestFrom($user->id))
                                <a href="#" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Following</a>
                            @elseif($user->hasSentFollowRequest($user->id))
                                <a href="#" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Requested</a>
                            @elseif($user->hasAcceptFollowRequest($user->id))
                                <a href="#" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Following</a>
                            @elseif($user->hasReceivedFollowBackRequest($user->id))
                                <a href="javascript:;" wire:click="acceptFollowBackRequest({{$user->id}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Accept</a>
                                <a href="javascript:;" wire:click="rejectFollowBackRequest({{$user->id}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Reject</a>
                             @elseif($user->hasAcceptedFollowing($user->id))
                                <a href="#" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Following</a>
                            @elseif($user->hasAcceptedFollower($user->id))
                                <a href="#" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Following</a>
                            @else
                                <a href="javascript:;" wire:click="followUser({{$user->id}})" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-lg font-medium text-gray-100 transition-all
                                duration-200 hover:bg-gray-700 rounded-lg">Follow</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <button wire:click="loadMore">Load More</button> --}}
            <div x-intersect="$wire.loadMore()"></div>
             {{-- {{ $users->links(data: ['scrollTo' => false]) }} --}}
        </div>
    </div>
</main>
{{-- <script>
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            alert("you're at the bottom of the page");
            Livewire.emit('load-more');
         }
    };
</script> --}}
</div>
