<!-- Header with name -->
<div class="flex flex-row items-center justify-between px-3 py-2 bg-gray-50 bg-opacity-40 border-b-2 border-gray-100">
    <div class="">
        <h2 class="font-medium">{{ $detailLaporan->subject }}</h2>
        <p class="text-xs text-gray-500">Laporan From {{ $detailLaporan->sender->name }}</p>
    </div>
</div>
<!-- Messages -->
<div class="flex-auto flex flex-col justify-between overflow-y-auto">

</div>
<!-- Input for writing a messages -->
<div class="flex flex-row justify-between items-center p-3">
    <div class="">
        <button type="button"
            class="p-2 text-gray-400 rounded-full hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring"
            aria-label="Upload a files">
            <svg class="fill-current h-6 w-6" viewBox="0 0 20 20">
                <path
                    d="M4.317,16.411c-1.423-1.423-1.423-3.737,0-5.16l8.075-7.984c0.994-0.996,2.613-0.996,3.611,0.001C17,4.264,17,5.884,16.004,6.88l-8.075,7.984c-0.568,0.568-1.493,0.569-2.063-0.001c-0.569-0.569-0.569-1.495,0-2.064L9.93,8.828c0.145-0.141,0.376-0.139,0.517,0.005c0.141,0.144,0.139,0.375-0.006,0.516l-4.062,3.968c-0.282,0.282-0.282,0.745,0.003,1.03c0.285,0.284,0.747,0.284,1.032,0l8.074-7.985c0.711-0.71,0.711-1.868-0.002-2.579c-0.711-0.712-1.867-0.712-2.58,0l-8.074,7.984c-1.137,1.137-1.137,2.988,0.001,4.127c1.14,1.14,2.989,1.14,4.129,0l6.989-6.896c0.143-0.142,0.375-0.14,0.516,0.003c0.143,0.143,0.141,0.374-0.002,0.516l-6.988,6.895C8.054,17.836,5.743,17.836,4.317,16.411">
                </path>
            </svg>
        </button>
    </div>
    <div class="flex-1 px-3">
        <input type="text"
            class="w-full border-2 border-gray-100 rounded-full px-4 py-1 outline-none text-gray-500 focus:outline-none focus:ring"
            placeholder="Write a message...">
    </div>
    <div class="flex flex-row">
        <button type="button"
            class="py-2 px-5 ml-2 text-white   rounded-full bg-blue-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring"
            aria-label="Record a voice">
            Send
        </button>
    </div>
</div>
