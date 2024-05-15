<x-app-layout>
    <div name="header" class="px-3 py-2 sm:px-6 sm:py-4 mb-5">
        <div class="flex items-center justify-center">
            <!-- Page wrapper -->
            <div class="w-full  lg:flex flex-col justify-start items-stretch">
                <!-- Header -->
                <header class="flex flex-row justify-between">
                    <a href="{{ route('report.index') }}"
                        class="py-1 mx-2 focus:outline-none hover:text-blue-700 focus:ring-gray-200">
                        <x-icon.backward class="w-7 ease-in-out duration-300 fill-biru dark:fill-blue-500"
                            viewBox="0 0 576 512" />
                    </a>
                    <div class="py-1 flex gap-1">
                        @if (Auth::user()->id == $detailLaporan->sender_id)
                            <a href="{{ route('report.edit', $detailLaporan) }}"
                                class="px-1 focus:outline-none hover:text-blue-700 focus:ring-gray-200">
                                <x-icon.edit class="w-7 ease-in-out duration-300 fill-biru dark:fill-blue-500"
                                    viewBox="0 0 576 512" />
                            </a>
                        @endif
                        <form action="{{ route('report.destroy', $detailLaporan->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-1 focus:outline-none hover:text-blue-700 focus:ring-gray-200">
                                <x-icon.trash class="w-7 ease-in-out duration-300 fill-biru dark:fill-blue-500"
                                    viewBox="0 0 576 512" />
                            </button>
                        </form>
                    </div>
                </header>
                <div class="border-b border-utama-hijau dark:border-blue-600 mb-3"></div>
                @include('components.alerts')
                <div class="mb-2">
                    <h3 class="font-semibold text-xl md:text-3xl font-system-ui text-black dark:text-white capitalize">
                        @if ($detailLaporan->roomType == 'public')
                            {{ __('Laporan Publik') }}
                        @elseif ($detailLaporan->roomType == 'private')
                            {{ __('Laporan Pribadi') }}
                        @else
                            {{ __('Laporan Anonim') }}
                        @endif
                    </h3>
                    <p class="text-md text-gray-900 dark:text-gray-200 font-system-ui pt-2">
                        @if ($detailLaporan->sender_id == Auth::user()->id)
                            @if ($detailLaporan->roomType == 'anonim')
                                {{ __('Laporan untuk') }} Anonim
                            @else
                                {{ __('Laporan untuk') }} {{ $detailLaporan->reciver_names }}
                            @endif
                        @else
                            @if ($detailLaporan->roomType == 'anonim')
                                {{ __('Laporan dari') }} Anonim
                            @else
                                {{ __('Laporan dari') }} {{ $detailLaporan->sender->name }}
                            @endif
                        @endif
                    </p>
                    <p class="text-md text-gray-900 dark:text-gray-200 font-system-ui capitalize">
                        Status : {{ $detailLaporan->status }}
                    </p>
                </div>

                <!-- Content -->
                <div class="flex-auto flex flex-row overflow-y-auto">
                    <div class="box w-full">
                        <!-- Konten -->
                        <div class="shadow-sm rounded-xl">
                            <section
                                class="px-3 py-4 sm:px-6 my-2 sm:py-8 mx-auto border-2 dark:border-blue-600 border-gray-200 bg-gray-50 dark:bg-darker shadow-sm rounded-xl min-h-[40rem]">
                                <!-- Header Detail -->
                                <header>
                                    <h1 class="text-xl md:text-2xl text-black dark:text-white font-system-ui font-bold">
                                        Detail Laporan</h1>
                                </header>
                                <div class="flex flex-col">
                                    <main class="min-h-[24rem] flex-grow">
                                        <h2
                                            class="mt-6 text-gray-900 text-md md:text-lg dark:text-gray-100 font-system-ui">
                                            Lokasi :<br>
                                            <span
                                                class="text-gray-700 text-sm md:text-md dark:text-gray-300">{{ $detailLaporan->lokasi }}</span>
                                        </h2>
                                        <div class="font-system-ui text-md md:text-lg text-black dark:text-white mt-4">
                                            Isi laporan :</div>
                                        <p class="text-gray-600 text-sm md:text-md dark:text-gray-300 font-system-ui">
                                            {{ $detailLaporan->message }}
                                        </p>

                                        @if (!$detailLaporan->attachments->isEmpty())
                                            <div class="my-5">
                                                <div id="accordion-flush" data-accordion="collapse"
                                                    data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                                                    data-inactive-classes="text-gray-500 dark:text-gray-400">
                                                    <h3 id="accordion-flush-heading-1">
                                                        <button type="button"
                                                            class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-900 bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 rounded p-3 dark:text-white"
                                                            data-accordion-target="#accordion-flush-body-1"
                                                            aria-expanded="true" aria-controls="accordion-flush-body-1">
                                                            <span>Attachments</span>
                                                            <svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </h3>
                                                    <div id="accordion-flush-body-1" class=""
                                                        aria-labelledby="accordion-flush-heading-1">
                                                        <div class="flex flex-col sm:flex-row gap-1 mt-2">
                                                            @foreach ($detailLaporan->attachments as $attachment)
                                                            <a href="{{$attachment->filename}}" target="_blank"
                                                                class="p-1 w-[200px] bg-gray-300 dark:bg-darker rounded-lg">
                                                                <img class="h-auto rounded-lg object-cover"
                                                                    src="{{$attachment->filename}}"
                                                                    alt="image description">
                                                            </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <p class="mt-2 text-gray-900 dark:text-gray-200">
                                            Terimakasih , <br>
                                            @if ($detailLaporan->roomType == 'anonim')
                                                {{ $detailLaporan->anonymous_name }}
                                            @else
                                                {{ $detailLaporan->sender->name }}
                                            @endif
                                        </p>
                                    </main>
                                    <footer class="mt-auto text-center">
                                        @if (auth()->check() && (auth()->user()->role_id == 1 || auth()->user()->role_id == 2))
                                            <h3 class="font-medium text-gray-800 dark:text-white">Action the Report</h3>
                                            <!-- Comment panel -->
                                            @include('layouts.comment', $detailLaporan)
                                            <div class="mt-6">
                                                <button @click="openComentsPanel" type="button"
                                                    class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm overflow-hidden text-white transition-colors duration-300 bg-gray-900 rounded-lg shadow sm:w-auto sm:mx-2 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-800 focus:ring focus:ring-gray-300 focus:ring-opacity-80">

                                                    <span class="mx-2">
                                                        Comment This Report
                                                    </span>
                                                </button>

                                                @if (($detailLaporan->status == 'terkirim') | ($detailLaporan->status == 'dibaca'))
                                                    <a href="{{ route('report.processingReport', $detailLaporan) }}"
                                                        class="inline-flex items-center justify-center w-full px-4 py-2.5 mt-4 text-sm overflow-hidden text-white transition-colors duration-300 bg-blue-600 rounded-lg shadow sm:w-auto sm:mx-2 sm:mt-0 hover:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                                        <span class="mx-2">
                                                            Process This Report
                                                        </span>
                                                    </a>
                                                @elseif($detailLaporan->status == 'diproses')
                                                    <a href="{{ route('report.finishReport', $detailLaporan) }}"
                                                        class="inline-flex items-center justify-center w-full px-4 py-2.5 mt-4 text-sm overflow-hidden text-white transition-colors duration-300 bg-green-600 rounded-lg shadow sm:w-auto sm:mx-2 sm:mt-0 hover:bg-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-80">
                                                        <span class="mx-2">
                                                            Done This Report
                                                        </span>
                                                    </a>
                                                @endif

                                            </div>
                                        @else
                                            <h3 class="font-medium text-gray-800 dark:text-white">Action the Report</h3>
                                            <!-- Comment panel -->
                                            @include('layouts.comment', $detailLaporan)
                                            <div class="mt-6">
                                                <button @click="openComentsPanel" type="button"
                                                    class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm overflow-hidden text-white transition-colors duration-300 bg-gray-900 rounded-lg shadow sm:w-auto sm:mx-2 hover:bg-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-80">

                                                    <span class="mx-2">
                                                        Comment This Report
                                                    </span>
                                                </button>
                                            </div>
                                        @endif
                                        <p class="mt-3 text-gray-500 dark:text-gray-400 text-sm">©
                                            {{ config('app.developer', 'E - Pengaduan Siswa') }}. All Rights
                                            Reserved.
                                        </p>
                                    </footer>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
