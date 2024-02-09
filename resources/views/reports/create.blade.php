<x-app-layout>
    <div name="header" class="px-6 py-4 md:p-4 mb-5">
        <h1 class="font-semibold text-2xl md:text-3xl mb-2 font-system-ui capitalize">
            {{ __('Laporan') }}
        </h1>
        <p class="text-sm mb-4 text-gray-400 dark:text-gray-400 font-system-ui capitalize ">
            {{ __('Daftar Seluruh Data Laporan Siswa SMPN 18 Malang') }}</p>
        <div class="border-b border-gray-300 my-5"></div>
        <!-- Page mother -->
        <div class="min-h-content">
            <!-- Page Alerts -->
            @include('components.alerts')

            <!-- Page wrapper -->
            <form action="{{ route('reportStore') }}" method="post">
                @csrf
                <input type="hidden" name="Sender_id" value="{{ auth()->id() }}">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-xl drop-shadow-lg">
                    <div class="text-2xl font-bold text-gray-600">
                        Buat Laporan Anda
                    </div>
                    <div class="max-w-full">
                        <div id="additionalInputsContainer" class="my-4 grid grid-cols-8 gap-4">

                            <div class="col-span-4">
                                <legend class="text-sm font-semibold leading-6 text-gray-900">Choose Your Type Report
                                </legend>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Pilihan Anda menentukan type laporan
                                    anda tolong bijaklah dalam memilih pilihan anda.</p>
                            </div>
                            <fieldset class="col-span-4">
                                <div class="space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="laporan-publik" name="roomType[]" value="public" type="radio" required
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="laporan-publik"
                                            class="block text-sm font-medium leading-6 text-gray-900">Laporan Publik
                                            <p class="text-gray-500 text-xs">Nama Anda Dan Laporan anda Dapat Dilihat
                                                Publik.</p>
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="laporan-privat" name="roomType[]" value="private" type="radio" required
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="laporan-privat"
                                            class="block text-sm font-medium leading-6 text-gray-900">Laporan Privat
                                            <p class="text-gray-500 text-xs">Laporan Anda Tidak Dapat Dilihat Publik.
                                            </p>
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="laporan-anonim" name="roomType[]" value="anonim" type="radio" required
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="laporan-anonim"
                                            class="block text-sm font-medium leading-6 text-gray-900">Laporan Anonymus
                                            <p class="text-gray-500 text-xs">Nama Anda Akan Disamarkan Dan Laporan Anda
                                                Tidak Dapat Dilihat Publik.</p>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-span-4" id="cloneRecipient">
                                <label for="recipient_id" class="block text-sm font-medium leading-6 text-gray-900">
                                    Choose Your Reciver</label>
                                <div class="mt-2">
                                    <select id="recipient_id" name="recipient[]" autocomplete="Reciver-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        @foreach ($dataGuru as $guru)
                                            <option value="{{ $guru->id }}">
                                                {{ $guru->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="addSelectInput()">
                            <p class="text-sm text-gray-900 dark:text-white">
                                Add More Receivers +
                            </p>
                        </button>


                        <div class="mt-4">
                            <label for="Subject"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject
                                Laporan</label>
                            <input type="text" id="Subject" name="Subject"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="my-2">
                            <div
                                class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                    <label for="Message" class="sr-only">Tuliskan Keluhan Anda</label>
                                    <textarea id="Message" rows="12" name="Message"
                                        class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Tuliskan Keluhan Anda..." required></textarea>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                    <button type="submit"
                                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                        <svg class="w-3.5 h-3.5 text-white me-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                            <path
                                                d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                            <path
                                                d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                        </svg>
                                        Kirim Keluhan
                                    </button>
                                    <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2">
                                        <button type="button"
                                            class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 12 20">
                                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                                    d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6" />
                                            </svg>
                                            <span class="sr-only">Attach file</span>
                                        </button>
                                        <button type="button"
                                            class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                            <svg class="w-4 h-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 16 20">
                                                <path
                                                    d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                            </svg>
                                            <span class="sr-only">Set location</span>
                                        </button>
                                        <button type="button"
                                            class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                            <svg class="w-4 h-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 18">
                                                <path
                                                    d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                            </svg>
                                            <span class="sr-only">Upload image</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addSelectInput() {
            // Clone the original select input
            var originalSelect = document.getElementById('cloneRecipient');
            var clonedSelect = originalSelect.cloneNode(true);

            // Reset the selected option in the cloned select
            clonedSelect.selectedIndex = 0;

            // Append the cloned select to the container
            document.getElementById('additionalInputsContainer').appendChild(clonedSelect);
        }
    </script>
</x-app-layout>
