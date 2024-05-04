<x-app-layout>
    <div name="header" class="p-2 mb-5">
        <div class="flex items-center justify-center">
            <!-- Page wrapper -->
            <div class="w-full  lg:flex flex-col justify-start items-stretch">
                <!-- Header -->
                <header class="flex flex-row justify-between">
                    <a href="{{ route('report.index') }}"
                        class="py-1 mx-2 focus:outline-none hover:text-blue-700 focus:ring-gray-200">
                        <x-icon.backward class="w-7 ease-in-out duration-300 fill-blue-500" viewBox="0 0 576 512" />
                    </a>
                    <div class="py-1 flex gap-1">
                        <a href="#" class="px-1 focus:outline-none hover:text-blue-700 focus:ring-gray-200">
                            <x-icon.edit class="w-7 ease-in-out duration-300 fill-blue-500" viewBox="0 0 576 512" />
                        </a>
                        <form action="{{ route('report.destroy', $detailLaporan->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-1 focus:outline-none hover:text-blue-700 focus:ring-gray-200">
                                <x-icon.trash class="w-7 ease-in-out duration-300 fill-blue-500"
                                    viewBox="0 0 576 512" />
                            </button>
                        </form>
                    </div>
                </header>
                <div class="border-b border-gray-300 mb-3"></div>
                @include('components.alerts')
                <div class="mb-2">
                    <h3 class="font-semibold text-lg md:text-3xl font-system-ui capitalize">
                        @if ($detailLaporan->roomType == 'public')
                            {{ __('Laporan Publik') }}
                        @elseif ($detailLaporan->roomType == 'private')
                            {{ __('Laporan Pribadi') }}
                        @else
                            {{ __('Laporan anonim') }}
                        @endif
                    </h3>
                    <p class="text-sm text-gray-400 dark:text-gray-400 font-system-ui capitalize">
                        @if ($detailLaporan->sender_id == Auth::user()->id)
                            @if ($detailLaporan->roomType == 'anonim')
                                {{ __('Laporan Untuk') }} Anonim
                            @else
                                {{ __('Laporan Untuk') }} {{ $detailLaporan->reciver_names }}
                            @endif
                        @else
                            @if ($detailLaporan->roomType == 'anonim')
                                {{ __('Laporan Dari') }} Anonim
                            @else
                                {{ __('Laporan Dari') }} {{ $detailLaporan->sender->name }}
                            @endif
                        @endif
                    </p>
                    <p class="text-sm text-gray-400 dark:text-gray-400 font-system-ui capitalize">
                        Status : {{ $detailLaporan->status }}
                    </p>
                </div>

                <!-- Content -->
                <div class="flex-auto flex flex-row overflow-y-auto">
                    <div class="box w-full">
                        <!-- Konten -->
                        <div class="mx-4 max-w p-4 bg-transparent lg:bg-gray-200 shadow-sm min-h-[45rem] rounded-xl">
                            <section
                                class="px-6 min-w-xl max-w-[50rem] my-2 py-8 mx-auto dark:bg-gray-900 bg-white shadow-sm rounded-xl min-h-[40rem]">
                                <!-- Header Detail -->
                                <header>
                                    <h1 class="text-2xl font-system-ui font-bold">Detail Laporan</h1>
                                </header>
                                <div class="flex flex-col">
                                    <main class="min-h-[24rem] flex-grow">
                                        <h2 class="mt-6 text-gray-700 dark:text-gray-200 font-system-ui">Subject :
                                            {{ $detailLaporan->subject }}</h2>

                                        <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300 font-system-ui">
                                            {{ $detailLaporan->message }}
                                        </p>

                                        @if (!$detailLaporan->attachments->isEmpty())
                                            <div class="mt-4">
                                                <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                                                    Attachments</h3>
                                                <div class="grid grid-cols-2 gap-4 mt-2">
                                                    @foreach ($detailLaporan->attachments as $attachment)
                                                        <a href="{{ asset('storage/' . $attachment->path) }}"
                                                            target="_blank"
                                                            class="flex items-center justify-center w-full h-32 p-4 text-sm overflow-hidden text-white transition-colors duration-300 bg-gray-900 rounded-lg shadow sm:w-auto sm:mx-2 hover:bg-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                                                            <x-icon.file-shield class="w-5 h-5 mx-2 fill-current" />
                                                            <span class="mx-2">{{ $attachment->name }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            {{-- ada --}}
                                        @endif
                                        {{-- <iframe class="w-full h-64 my-10 rounded-lg md:h-80" src="https://www.youtube.com/embed/L6Jwa7al8os" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}

                                        <p class="mt-2 text-gray-600 dark:text-gray-300">
                                            Terimakasih , <br>
                                            @if ($detailLaporan->roomType == 'anonim')
                                                Anonim
                                            @else
                                                {{ $detailLaporan->sender->name }}
                                            @endif
                                        </p>
                                    </main>
                                    <footer class="mt-auto text-center">
                                        <h3 class="font-medium text-gray-800 dark:text-white">Action the Report</h3>
                                        <div class="mt-6">
                                            <a href="#"
                                                class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm overflow-hidden text-white transition-colors duration-300 bg-gray-900 rounded-lg shadow sm:w-auto sm:mx-2 hover:bg-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                                                {{-- <x-mdi-comment-processing-outline class="w-5 h-5 mx-2 fill-current" /> --}}

                                                <span class="mx-2">
                                                    Comment This Report
                                                </span>
                                            </a>

                                            <a href="#"
                                                class="inline-flex items-center justify-center w-full px-4 py-2.5 mt-4 text-sm overflow-hidden text-white transition-colors duration-300 bg-blue-600 rounded-lg shadow sm:w-auto sm:mx-2 sm:mt-0 hover:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                                {{-- <x-fas-file-shield class="w-5 h-5 mx-2 fill-current" /> --}}

                                                <span class="mx-2">
                                                    Process This Report
                                                </span>
                                            </a>
                                        </div>

                                        <p class="mt-3 text-gray-500 dark:text-gray-400">©
                                            {{ config('app.developer', 'E - Pengaduan Siswa') }}. All Rights Reserved.
                                        </p>
                                    </footer>
                                </div>
                            </section>
                        </div>
                        {{-- <div class="p-5">
                            {{ $detailLaporan }}
                        </div> --}}
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
