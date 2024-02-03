<div>
    {{-- Do your work, then step back. --}}
      <!-- Main modal -->
<div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
</div>
</div>
