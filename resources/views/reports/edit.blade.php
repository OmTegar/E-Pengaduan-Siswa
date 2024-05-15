<x-app-layout>
    <div class="p-2 absolute bottom-2 w-[96%] lg:w-[50%] right-3 sm:right-5 z-50 hidden">
        <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
            <div id="preview" class="flex flex-wrap gap-2 overflow-y-auto h-[400px]"></div>
        </div>
    </div>
    <div name="header" class="px-3 py-2 sm:px-6 sm:py-4 md:p-4 mb-5">
        <!-- Page Alerts -->
        @include('components.alerts')
        <h1 class="font-semibold text-2xl md:text-3xl mb-2 font-system-ui capitalize">
            {{ __('Laporan') }}
        </h1>
        <p class="text-sm mb-4 text-gray-400 dark:text-gray-400 font-system-ui capitalize ">
            {{ __('Daftar Seluruh Data Laporan Siswa SMPN 18 Malang') }}</p>
        <div class="border-b border-gray-300 my-5"></div>
        <!-- Page mother -->
        <div class="min-h-content">

            <!-- Page wrapper -->
            <form action="{{ route('report.update', $report) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH') <!-- atau @method('PUT') -->
                <input type="hidden" name="Sender_id" value="{{ $report->sender_id }}">
                <div
                    class="p-4 sm:p-8 bg-gray-50 border-gray-100 dark:bg-darker border-2 dark:border-blue-600 shadow rounded-xl drop-shadow-lg">
                    <div class="text-2xl font-bold text-gray-600 dark:text-white">
                        Perbarui Laporan Anda
                    </div>
                    <div class="max-w-full">
                        <div id="additionalInputsContainer" class="my-4 flex flex-col sm:flex-row gap-4">

                            <div class="col-span-4">
                                <legend class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Choose
                                    Your Type Report
                                </legend>
                                <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-white">Pilihan Anda menentukan
                                    type laporan
                                    anda tolong bijaklah dalam memilih pilihan anda.</p>
                            </div>
                            <fieldset class="col-span-4">
                                <div class="space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="laporan-publik" name="roomType[]" value="public" type="radio"
                                            {{ $report->roomType === 'public' ? 'checked' : '' }}
                                            class="h-4 w-4 border-gray-300 text-biru focus:ring-biru">
                                        <label for="laporan-publik"
                                            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Laporan
                                            Publik
                                            <p class="text-gray-500 text-xs dark:text-gray-300">Nama Anda Dan Laporan
                                                anda Dapat Dilihat
                                                Publik.</p>
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="laporan-privat" name="roomType[]" value="private" type="radio"
                                            {{ $report->roomType === 'private' ? 'checked' : '' }}
                                            class="h-4 w-4 border-gray-300 text-biru focus:ring-biru">
                                        <label for="laporan-privat"
                                            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Laporan
                                            Privat
                                            <p class="text-gray-500 text-xs dark:text-gray-300">Laporan Anda Tidak Dapat
                                                Dilihat Publik.
                                            </p>
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="laporan-anonim" name="roomType[]" value="anonim" type="radio"
                                            {{ $report->roomType === 'anonim' ? 'checked' : '' }}
                                            class="h-4 w-4 border-gray-300 text-biru focus:ring-biru">
                                        <label for="laporan-anonim"
                                            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Laporan
                                            Anonymus
                                            <p class="text-gray-500 text-xs dark:text-gray-300">Nama Anda Akan
                                                Disamarkan Dan Laporan Anda
                                                Tidak Dapat Dilihat Publik.</p>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-span-4 p-3 mt-2 bg-gray-100 dark:bg-[#0a2647] rounded-md w-full">
                            <div class="flex items-center align-middle">
                                <p class="text-sm text-gray-900 dark:text-white pt-2 ps-2">
                                    Pilih Penerima Laporan Anda / Pilih semua
                                <div class="flex text-center items-center ms-6">
                                    <input id="check_all" type="checkbox"
                                        class="w-4 h-4 mt-2 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="check_all" class="text-sm text-gray-900 dark:text-white pt-2 ps-2">Check
                                        All </label>
                                </div>
                            </div>
                            <div class="border-b border-gray-300 my-2"></div>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($dataGuru as $guru)
                                    <div class="flex items-center me-4 mb-4 min-w-[18rem]">
                                        <input id="recipient_id_{{ $guru->id }}" type="checkbox"
                                            value="{{ $guru->id }}" name="recipient[]"
                                            class="w-6 h-6 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            {{ in_array($guru->id, $report->reciver->pluck('reciver_id')->toArray()) ? 'checked' : '' }}>
                                        <label for="recipient_id_{{ $guru->id }}"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $guru->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="Lokasi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi
                                Kejadian</label>
                            <input type="text" id="Lokasi" name="Lokasi" placeholder="Didepan Ruang 27"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-[#0a2647] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $report['lokasi'] }}">
                        </div>

                        <div class="my-2">
                            <div
                                class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-[#0a2647]">
                                    <label for="Message" class="sr-only">Tuliskan Keluhan Anda</label>
                                    <textarea id="Message" rows="12" name="Message"
                                        class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-[#0a2647] focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Tuliskan Keluhan Anda..." required>{{ $report['message'] }}</textarea>
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
                                        Simpan Perubahan
                                    </button>
                                    <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2">
                                        <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2">
                                            <label for="attachment"
                                                class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                <x-icon.attach-file class="w-4 h-4" aria-hidden="true"
                                                    viewBox="0 0 12 20" fill="none" />
                                                <span class="sr-only">Attach file</span>
                                            </label>
                                            <input id="attachment" type="file" name="attachment[]" class="hidden"
                                                accept="image/*" multiple onchange="previewFiles()">
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <span id="show_name_file" class="hidden text-sm">Foto yang Anda pilih :</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('src/js/report.js') }}"></script>
</x-app-layout>
