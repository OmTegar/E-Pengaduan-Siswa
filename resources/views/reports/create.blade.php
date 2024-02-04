<x-app-layout>
    <!-- Page mother -->
    <div class="min-h-content">
        <!-- Page Alerts -->
        @include('components.alerts')

        <!-- Page wrapper -->
        <form action="{{ route('reportStore') }}" method="post">
            @csrf
            <input type="hidden" name="Sender_id" value="{{ auth()->id() }}">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow">
                <div class="max-w-full">
                    <div class="my-4" id="cloneRecipient">
                        <label for="recipient_id" class="sr-only">Choose Your Reciver</label>
                        <select id="recipient_id" name="recipient[]"
                            class="py-2.5 px-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option hidden>Choose Your Reciver</option>
                            @foreach ($dataGuru as $guru)
                                <option value="{{ $guru->id }}">
                                        {{ $guru->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="additionalInputsContainer" class="my-4"></div>
                    <button type="button" onclick="addSelectInput()">
                        <p class="text-sm text-gray-900 dark:text-white">
                            Add More Receivers +
                        </p>
                    </button>
                    <div class="mt-4">
                        <label for="Subject"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject Laporan</label>
                        <input type="text" id="Subject" name="Subject"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="my-2">
                        <div
                            class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                <label for="Message" class="sr-only">Tuliskan Keluhan Anda</label>
                                <textarea id="Message" rows="16" name="Message"
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
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 16 20">
                                            <path
                                                d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                        </svg>
                                        <span class="sr-only">Set location</span>
                                    </button>
                                    <button type="button"
                                        class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                        </svg>
                                        <span class="sr-only">Upload image</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p class="ms-auto text-xs text-gray-500 dark:text-gray-400">Remember, contributions to this
                            topic should follow our <a href="#"
                                class="text-blue-600 dark:text-blue-500 hover:underline">Community Guidelines</a>.</p>
                    </div>
                </div>
            </div>
        </form>
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
