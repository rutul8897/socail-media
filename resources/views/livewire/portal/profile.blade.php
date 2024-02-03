<div>
<main class="gap-6 my-5 w-2xl container px-2 mx-auto">
     <aside class="">
        <div x-data="{ isEditing: false }" class="bg-white shadow rounded-lg p-10">
            <div class="flex flex-col gap-1 text-center items-center">
                <img class="h-32 w-32 bg-white p-2 rounded-full shadow mb-4" src="{{ is_string($photo) ? $photo : $photo->temporaryUrl()  }}" alt="">
                <p class="font-semibold">{{ $user->name }}</p>
                @if($user->location)
                <p>{{ $user->about }}</p>
                @endif
                @if($user->location)
                <div class="text-sm leading-normal text-gray-400 flex justify-center items-center">
                <svg viewBox="0 0 24 24" class="mr-1" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                {{ $user->location }}
                </div>
                @endif
            </div>
            <div class="flex justify-center mt-4">
                <button @click="isEditing = !isEditing" class="bg-blue-500 text-white py-2 px-4 rounded-full">Edit Profile</button>
            </div>

            <div x-show="!isEditing" class="flex justify-center items-center gap-2 my-3">
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">{{ $totalUserPost }}</p>
                    <span class="text-gray-400">Posts</span>
                </div>
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">{{ $totalFollowerUser }}</p>
                    <span class="text-gray-400">Followers</span>
                </div>
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">{{ $totalFollowingUser }}</p>
                    <span class="text-gray-400">Folowing</span>
                </div>
            </div>

            <div x-show="isEditing" class="mt-4">
                <h2 class="text-2xl font-semibold mb-4">Update Profile</h2>
                <form wire:submit.prevent="updateProfile">
                    <!-- Your editable form fields go here -->
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-600">Name</label>
                        <input type="text" id="username" wire:model="name" class="mt-1 p-2 border rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="about"  class="block text-sm font-medium text-gray-600">About</label>
                        <input type="text" id="about" wire:model="about" class="mt-1 p-2 border rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-600">Location</label>
                        <input type="text" id="location" wire:model="location" class="mt-1 p-2 border rounded-md w-full">
                    </div>
                    <div class="flex gap-2 mb-4">
                        <label for="photo" class="flex items-center transition ease-out duration-300 hover:bg-blue-500 hover:text-white bg-blue-100  px-2 rounded-full text-blue-400 cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-2 pb-2">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </div>
                            <input id="photo" wire:model.live="photo" type="file" class="hidden" accept="image/*" />
                        </label>
                    </div>
                    @if ($photo)
                    <div class="flex flex-row pt-2">
                        <div class="px-2">
                            <img src="{{ is_string($photo) ? $photo : $photo->temporaryUrl() }}" width="200px" height="200px">
                        </div>
                    </div>
                    @endif
                    <div class="flex mt-2 justify-between">
                        {{-- <button @click="isEditing = false" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:underline ml-4">Cancel</button> --}}
                        <button type="submit"  class="bg-green-500 text-white py-2 px-4 rounded-full">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="bg-white shadow mt-6 rounded-lg p-6 overflow-x-auto">
            <h3 class="text-gray-600 text-sm font-semibold mb-4 sticky top-0 bg-white z-10 px-6">
                Followings
            </h3>
            <ul id="storiesContainer" class="flex space-x-4 p-4 list-none">
                <!-- Your story items here -->
                <!-- Example: Add 11 story items dynamically -->
               @forelse($followingUsers as $followingUser)
                <li class="flex-shrink-0 flex flex-col items-center">
                    <a class="block bg-white p-1 rounded-full" href="#">
                        <img class="w-16 rounded-full" src="{{ $followingUser->following->photo }}">
                    </a>
                    <!-- Username -->
                    <span class="text-xs text-gray-500 mt-1">
                        {{ $followingUser->following->name }}
                    </span>
                </li>
                @empty
                    <p>No Following Users Found.</p>
                @endforelse
            </ul>
        </div>

        {{-- <div class="flex bg-white shadow mt-6  rounded-lg p-2">
            <img src="https://images.unsplash.com/photo-1439130490301-25e322d88054?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1189&amp;q=80" alt="Just a flower" class=" w-16  object-cover  h-16 rounded-xl">
            <div class="flex flex-col justify-center w-full px-2 py-1">
                <div class="flex justify-between items-center ">
                    <div class="flex flex-col">
                        <h2 class="text-sm font-medium">Massive Dynamic</h2>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-blue-400 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                </div>
                <div class="flex pt-2  text-sm text-gray-400">
                    <div class="flex items-center mr-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <p class="font-normal">4.5</p>
                    </div>
                    <div class="flex items-center font-medium text-gray-900 ">
                        $1800
                        <span class="text-gray-400 text-sm font-normal"> /wk</span>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="grid mt-5 grid-cols-2  space-x-4 overflow-y-scroll flex justify-center items-center w-full ">
            <div class="relative flex flex-col justify-between   bg-white shadow-md rounded-3xl  bg-cover text-gray-800  overflow-hidden cursor-pointer w-full object-cover object-center rounded shadow-md h-64 my-2" style="background-image:url('https://images.unsplash.com/reserve/8T8J12VQxyqCiQFGa2ct_bahamas-atlantis.jpg?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80')">
                <div class="absolute bg-gradient-to-t from-green-400 to-blue-400  opacity-50 inset-0 z-0"></div>
                <div class="relative flex flex-row items-end  h-72 w-full ">
                    <div class="absolute right-0 top-0 m-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 p-2 text-gray-200 hover:text-blue-400 rounded-full hover:bg-white transition ease-in duration-200 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </div>
                    <div class="p-6 rounded-lg  flex flex-col w-full z-10 ">
                        <h4 class="mt-1 text-white text-xl font-semibold  leading-tight truncate">Loremipsum..
                        </h4>
                        <div class="flex justify-between items-center ">
                            <div class="flex flex-col">
                                <h2 class="text-sm flex items-center text-gray-300 font-normal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Dubai
                                </h2>
                            </div>
                        </div>
                        <div class="flex pt-4  text-sm text-gray-300">
                            <div class="flex items-center mr-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <p class="font-normal">4.5</p>
                            </div>
                            <div class="flex items-center font-medium text-white ">
                                $1800
                                <span class="text-gray-300 text-sm font-normal"> /wk</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative flex flex-col justify-between   bg-white shadow-md  rounded-3xl  bg-cover text-gray-800  overflow-hidden cursor-pointer w-full object-cover object-center rounded shadow-md h-64 my-2" style="background-image:url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80')">
                <div class="absolute bg-gradient-to-t from-blue-500 to-yellow-400  opacity-50 inset-0 z-0"></div>
                <div class="relative flex flex-row items-end  h-72 w-full ">
                    <div class="absolute right-0 top-0 m-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 p-2 text-gray-200 hover:text-blue-400 rounded-full hover:bg-white transition ease-in duration-200 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </div>
                    <div class="p-5 rounded-lg  flex flex-col w-full z-10 ">
                        <h4 class="mt-1 text-white text-xl font-semibold  leading-tight truncate">Loremipsum..
                        </h4>
                        <div class="flex justify-between items-center ">
                            <div class="flex flex-col">
                                <h2 class="text-sm flex items-center text-gray-300 font-normal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    India
                                </h2>
                            </div>
                        </div>
                        <div class="flex pt-4  text-sm text-gray-300">
                            <div class="flex items-center mr-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <p class="font-normal">4.5</p>
                            </div>
                            <div class="flex items-center font-medium text-white ">
                                $1800
                                <span class="text-gray-300 text-sm font-normal"> /wk</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </aside>
</main>
 <script>
            // Adjust the visibility of the scrollbar after 10 items
                const container = document.getElementById('storiesContainer');
                container.style.overflowX = container.scrollWidth > container.clientWidth ? 'scroll' : 'auto';
            </script>
    </div>