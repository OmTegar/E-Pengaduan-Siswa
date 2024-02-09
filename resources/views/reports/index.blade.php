<x-app-layout>
    <div name="header" class="px-6 py-4 md:p-4 mb-5">
        <h1 class="font-semibold text-2xl md:text-3xl mb-2 font-system-ui capitalize">
            {{ __('Laporan') }}
        </h1>
        <p class="text-sm mb-4 text-gray-400 dark:text-gray-400 font-system-ui capitalize ">{{ __('Daftar Seluruh Data Laporan Siswa SMPN 18 Malang') }}</p>
        <div class="border-b border-gray-300 my-5"></div>
        <!-- Page mother -->
        <div class="flex items-center justify-center min-h-content rounded-xl drop-shadow-lg">
            <!-- Page wrapper -->
            <section class="shadow-xl w-full lg:mx-auto flex min-h-content rounded-xl">
                <!-- Left section -->
                <div class="w-full flex flex-col justify-start items-stretch bg-gray-200 bg-opacity-70 dark:bg-gray-800 p-3 rounded-l-xl">
                    <div class="flex flex-row justify-between items-center mb-2">
                        <div class="flex flex-row">
                            <button
                                class="bg-red-500 text-white rounded-full p-1 mr-2 cursor-pointer h-4 w-4 focus:outline-none focus:ring"
                                aria-label="Close">
                            </button>
                            <button
                                class="bg-yellow-500 text-white rounded-full p-1 mr-2 cursor-pointer h-4 w-4 focus:outline-none focus:ring"
                                aria-label="Restore Down">
                            </button>
                            <button
                                class="bg-green-500 text-white rounded-full p-1 mr-5 cursor-pointer h-4 w-4 focus:outline-none focus:ring"
                                aria-label="Minimize">
                            </button>
                        </div>
                        <div class="w-full pt-1">
                            <input type="text" placeholder="Search"
                                class="search-input bg-gray-600 bg-opacity-10 placeholder-gray-500 text-gray-400 text-sm py-1 px-10 rounded-md outline-none w-full focus:outline-none focus:ring" />
                        </div>
                        @if (Auth::user()->role_id != 2)
                            <div class="mx-4 rounded-md text-gray-500 bg-red-500">
                                <a href="{{ route('report.create') }}"
                                    class="flex flex-col justify-center items-center px-6 py-1 rounded-md focus:ring-2 hover:bg-gray-50 hover:bg-opacity-30 focus:outline-none"
                                    aria-label="Add">
                                    <img src="{{ asset('src/icon/add.png') }}" class="max-w-8" alt="create-laporan">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="flex-auto flex flex-col">
                        <div class="flex-auto flex flex-row">
                            <div class="w-full p-1">
                                {{-- email from ..... --}}
                                <ul class="overflow-y-auto">
                                    @isset($getLaporan)
                                        @foreach ($getLaporan as $key => $laporan)
                                            <a class="my-2 p-2 flex flex-row cursor-pointer rounded-lg hover:bg-blue-600 hover:shadow-lg transition ease-in-out duration-150"
                                                href="{{ route('report.show', $laporan->id) }}">
                                                @if ($laporan->sender->name == Auth::user()->name)
                                                    @if ($laporan->avatar_recivers != null)
                                                        <img class="h-12 w-12 rounded-full mr-4"
                                                            src="{{ asset('storage/images/' . $laporan->avatar_recivers) }}"
                                                            alt="{{ $laporan->reciver_names }}" />
                                                    @else
                                                        <img class="h-12 w-12 rounded-full mr-4"
                                                            :src="generateAvatar('{{ $laporan->email_recivers }}')"
                                                            alt="{{ $laporan->reciver_names }}" />
                                                    @endif
                                                @else
                                                    @if ($laporan->sender->avatar_url != null)
                                                        <img class="h-12 w-12 rounded-full mr-4"
                                                            src="{{ asset('storage/images/' . $laporan->sender->avatar_url) }}"
                                                            alt="{{ $laporan->sender->name }}" />
                                                    @else
                                                        <img class="h-12 w-12 rounded-full mr-4"
                                                            :src="generateAvatar('{{ $laporan->sender->email }}')"
                                                            alt="{{ $laporan->sender->name }}" />
                                                    @endif
                                                @endif
    
                                                <script>
                                                    function generateAvatar(email) {
                                                        const name = email.substring(0, 2); // ambil dua huruf pertama dari email
                                                        const url = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&size=64&background=random`;
                                                        return url;
                                                    }
                                                </script>
                                                <div class="w-full flex flex-col justify-center">
                                                    <div class="flex flex-row justify-between items-center">
                                                        <h2 class="text-sm font-semibold font-system-ui">
                                                            @if ($laporan->sender->name == Auth::user()->name)
                                                                Laporan To {{ $laporan->reciver_names }}
                                                            @else
                                                                Laporan From {{ $laporan->sender->name }}
                                                            @endif
                                                        </h2>
                                                        <div class="flex flex-row">
                                                            <p class="text-sm font-system-ui font-light">
                                                                @if ($laporan->sender->name == Auth::user()->name)
                                                                    {{ $laporan->status }}
                                                                @else
                                                                    @if ($laporan->status == 'terkirim')
                                                                        laporan baru
                                                                    @elseif ($laporan->status == 'dibaca')
                                                                        laporan dibaca
                                                                    @elseif ($laporan->status == 'diproses')
                                                                        laporan diproses
                                                                    @elseif ($laporan->status == 'selesai')
                                                                        laporan selesai
                                                                    @endif
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-row justify-between items-center my-1">
                                                        <p class="text-sm font-system-ui font-light text-gray-400">
                                                            {{ __($laporan->message) }}
                                                        </p>
                                                        <p class="text-sm text-gray-400 dark:text-gray-400">
                                                            {{ __($laporan->created_at->diffForHumans()) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endisset
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right section -->
                <div
                    class="hidden w-9/12 lg:flex flex-col justify-start items-stretch border-r dark:border-blue-800 rounded-r-xl">
                    <div class="flex items-center justify-center w-full h-full rounded-r-xl">
                        <img src="{{ asset('img/login.jpg')}}" class="object-cover w-full h-full rounded-r-xl">
                    </div>
                </div>
            </section>
        </div>
    </div>
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        {{-- <script>
        function detailLaporanRequest(id) {
            fetch("/report-show/" + id, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({
                        uuid: id
                    }),
                })
                .then((response) => {
                    if (!response.ok) throw Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then((data) => {
                    const detailLaporanTab = document.getElementById("detailLaporanTab");
                    detailLaporanTab.innerHTML = data.detailReport;
                    console.log(data);
                })
                .catch((error) => console.error("Error:", error));
        }
    </script> --}}
</x-app-layout>
