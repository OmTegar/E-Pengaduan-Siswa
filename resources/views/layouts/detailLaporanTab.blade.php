<x-app-layout>
    <div name="header" class="px-6 py-4 md:p-4 mb-5">
        <h1 class="font-semibold text-2xl md:text-3xl mb-2 font-system-ui capitalize">
            {{ __('Laporan') }}
        </h1>
        <p class="text-sm mb-4 text-gray-400 dark:text-gray-400 font-system-ui capitalize">
            @if ($detailLaporan->sender_id == Auth::user()->id)
                {{ __('Laporan Untuk') }} {{ $detailLaporan->reciver_names }}
            @else
                {{ __('Laporan Dari') }} {{ $detailLaporan->sender->name }}
            @endif
        </p>
        <div class="border-b border-gray-300 my-5"></div>
        <!-- Page mother -->
        <div class="flex items-center justify-center min-h-content drop-shadow-lg">
            <!-- Page wrapper -->
            <div class="w-full min-h-content bg-white lg:flex flex-col justify-start items-stretch">
                <!-- Header -->
                <header class="flex flex-row justify-between bg-gray-200 border-opacity-50">
                    <a href="{{ route('report.index') }}"
                        class="px-1 mx-2 focus:outline-none hover:text-blue-700 focus:ring-gray-200">
                        <x-bx-arrow-back class="w-8 ease-in-out duration-300" />
                    </a>
                    <div class="py-1 px-5 me-2">
                        <p>konten samping kanan</p>
                    </div>
                </header>

                <!-- Content -->
                <div class="flex-auto flex flex-row overflow-y-auto bg-white">
                    <div class="box min-[1280px]w-2/12 min-[1024px]:w-3/12 pt-2 flex border-e-2 bg-opacity-65 min-h-content max-[1024px]:w-full">
                        <!-- Konten di sisi kiri -->
                        <ul class="list-outside pl-1 w-full">
                            <li class="font-semibold font-system-ui">
                                <a href="#" class="text-md">Detail Laporan</a>
                                <ul class="list-outside pl-5 mt-1">
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Detail Laporan</a></li>
                                </ul>
                            </li>
                            <li class="font-semibold font-system-ui">
                                <a href="#" class="text-md font-semibold">Progres Laporan</a>
                                <ul class="list-outside pl-5 mt-1">
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Sub Detail 1 ihvfhefvehfjefv hjefvjevfjjvfejv</a></li>
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Sub Detail 2</a></li>
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Sub Detail 3</a></li>
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Sub Detail 4</a></li>
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Sub Detail 5</a></li>
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Sub Detail 6</a></li>
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Sub Detail 7</a></li>
                                </ul>
                            </li>
                            <li class="font-semibold font-system-ui">
                                <a href="#" class="text-md font-semibold">Review Laporan</a>
                                <ul class="list-outside pl-5 mt-1">
                                    <li class="flex"><x-tabler-letter-l class="-translate-y-1.5 min-w-[24px] min-h-[24px]"/><a href="#" class="text-xs translate-y-1">Sub Message</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                    <div class="box min-[1280px]:w-10/12 min-[1024px]:w-9/12 h-20 bg-opacity-65 min-[1024px]:blok max-[1024px]:hidden">
                        <!-- Konten di sisi kanan -->
                        <div class="p-5">
                            <h1>konten 1</h1>
                        </div>
                    </div>
                </div>

                <!-- Input for writing a messages -->
                {{-- <div class="flex flex-row justify-between items-center p-3 rounded-b-xl">
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
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
