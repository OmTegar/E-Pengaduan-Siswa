<x-welcome-layout>
    <section class="bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-16 pt-28 sm:pt-24">
            <div class="flex items-center justify-center">
                <!-- Page wrapper -->
                <div class="w-full  lg:flex flex-col justify-start items-stretch">
                    @include('components.alerts')
                    <div class="mb-2">
                        <h3
                            class="font-semibold text-xl md:text-3xl font-system-ui text-black dark:text-white capitalize">
                            {{ __('Laporan Publik') }}
                        </h3>
                        <p class="text-md text-gray-900 dark:text-gray-200 font-system-ui pt-2">
                            {{ __('Laporan dari') }} {{ $report->sender->name }}
                        </p>
                    </div>
                    <!-- Content -->
                    <div class="flex-auto flex flex-row overflow-y-auto">
                        <div class="box w-full">
                            <!-- Konten -->
                            <div class="shadow-sm rounded-xl">
                                <section
                                    class="px-3 py-4 sm:px-6 my-2 sm:py-8 mx-auto border-2 dark:border-gray-900 border-gray-200 bg-gray-50 dark:bg-gray-800 shadow-sm rounded-xl pb-16">
                                    <!-- Header Detail -->
                                    <header>
                                        <h1
                                            class="text-xl md:text-2xl text-black dark:text-white font-system-ui font-bold">
                                            Detail Laporan</h1>
                                    </header>
                                    <div class="flex flex-col">
                                        <main class="min-h-[24rem] flex-grow">
                                            <h2 class="mt-6 text-gray-900 text-md md:text-lg dark:text-gray-100">Lokasi
                                                : {{ $report->lokasi }}
                                            </h2>
                                            <div
                                                class="font-system-ui text-md md:text-lg text-black dark:text-white mt-4">
                                                Isi laporan :</div>
                                            <p
                                                class="text-gray-600 text-sm md:text-md dark:text-gray-300 font-system-ui">
                                                {{ $report->message }}
                                            </p>

                                            @if (!$report->attachments->isEmpty())
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
                                                            <svg data-accordion-icon=""
                                                                class="w-6 h-6 rotate-180 shrink-0" fill="currentColor"
                                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </h3>
                                                    <div id="accordion-flush-body-1" class=""
                                                        aria-labelledby="accordion-flush-heading-1">
                                                        <div class="flex flex-col sm:flex-row gap-1 mt-2">
                                                            @foreach ($report->attachments as $attachment)
                                                            <a href="" target="_blank"
                                                                class="p-1 w-[200px] bg-gray-300 dark:bg-darker rounded-lg">
                                                                <img class="h-auto rounded-lg object-cover"
                                                                    src="{{ $attachment->filename }}"
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
                                                {{ $report->sender->name }}
                                            </p>
                                        </main>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-welcome-layout>
