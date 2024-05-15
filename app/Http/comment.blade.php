<!-- Backdrop -->
<div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="isComentsPanelOpen"
    @click="isComentsPanelOpen = false" class="fixed inset-0 z-10 bg-blue-800" style="opacity: 0.5" aria-hidden="true">
</div>

<!-- panel -->
<section x-cloak x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" x-ref="settingsPanel"
    tabindex="-1" x-show="isComentsPanelOpen" @keydown.escape="isComentsPanelOpen = false"
    class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
    aria-labelledby="commentsPanelLabel">
    <div class="absolute left-0 p-2 transform -translate-x-full">
        <!-- Close button -->
        <button @click="isComentsPanelOpen = false" class="p-2 text-white rounded-md focus:outline-none focus:ring">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <!-- Panel content -->
    <div class="flex flex-col h-screen">
        <!-- Panel header -->
        <div
            class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b dark:border-blue-700">
            <span aria-hidden="true" class="text-gray-500 dark:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#9CA3AF"
                    height="80px" width="80px" version="1.1" id="Capa_1" viewBox="0 0 60 60"
                    xml:space="preserve">
                    <g>
                        <path
                            d="M57.348,0.793H12.652C11.189,0.793,10,1.983,10,3.446v7.347h34.348c2.565,0,4.652,2.087,4.652,4.653v25.347h1.586   L60,50.207V3.446C60,1.983,58.811,0.793,57.348,0.793z" />
                        <path
                            d="M44.348,12.793H2.652C1.189,12.793,0,13.983,0,15.446v43.761l9.414-9.414h34.934c1.463,0,2.652-1.19,2.652-2.653V15.446   C47,13.983,45.811,12.793,44.348,12.793z M11,22.793h12c0.553,0,1,0.448,1,1s-0.447,1-1,1H11c-0.553,0-1-0.448-1-1   S10.447,22.793,11,22.793z M36,38.793H11c-0.553,0-1-0.448-1-1s0.447-1,1-1h25c0.553,0,1,0.448,1,1S36.553,38.793,36,38.793z    M36,31.793H11c-0.553,0-1-0.448-1-1s0.447-1,1-1h25c0.553,0,1,0.448,1,1S36.553,31.793,36,31.793z" />
                    </g>
                </svg>
            </span>
            <h2 id="commentsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">Comments</h2>
        </div>
        <!-- Content -->
        <div class="flex-1 overflow-hidden hover:overflow-y-auto">
            <!-- Theme -->
            <div class="p-4 space-y-4 md:p-8">
                <h6 class="text-lg font-medium text-gray-400 dark:text-light">Komentar Laporan</h6>

                <!-- Box Comment -->
                <section class="mt-4">
                    <!-- Comment 1 -->
                    @if ($detailLaporan)
                        @if ($detailLaporan->comments->isNotEmpty())
                            <!-- Periksa apakah koleksi 'comments' tidak kosong -->
                            @foreach ($detailLaporan->comments as $comment)
                                <!-- Iterasi melalui setiap komentar -->
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $detailLaporan->avatar_recivers }}" alt="Foto Profil"
                                            class="w-8 h-8 rounded-full">
                                    </div>
                                    <div class="ml-3">
                                        @if ($comment->user_id == Auth::user()->id)
                                            @if ($detailLaporan->roomType == 'anonim' && $detailLaporan->sender_id == Auth::user()->id)
                                                <p class="font-semibold text-left">{{ $detailLaporan->anonymous_name }}
                                                    (Anda)
                                                </p>
                                            @else
                                                <p class="font-semibold text-left">{{ $comment->user->name }} (Anda)</p>
                                            @endif
                                        @else
                                            @if ($detailLaporan->roomType == 'anonim' && $detailLaporan->sender_id == $comment->user_id)
                                                <p class="font-semibold text-left">{{ $detailLaporan->anonymous_name }}
                                                </p>
                                            @else
                                                <p class="font-semibold text-left">{{ $comment->user->name }}</p>
                                            @endif
                                        @endif
                                        <p class="text-gray-500 text-left">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <p>Data laporan tidak ditemukan.</p>
                    @endif
                </section>

                <!-- Comment -->
                <div class="flex items-center space-x-8">
                    <!-- Input for writing a messages -->
                    <form action="{{ route('report.commentReport', $detailLaporan->id) }}" method="post">
                        @csrf
                        <div class="flex flex-row justify-between items-center p-3 rounded-b-xl">
                            <div class="flex-1 px-3">
                                <input type="text" id="comment" name="comment"
                                    class="w-full border-2 border-gray-100 rounded-full px-4 py-1 outline-none text-gray-500 focus:outline-none focus:ring"
                                    placeholder="Tuliskan Komentar anda...">
                            </div>
                            <div class="flex flex-row">
                                <button type="submit"
                                    class="py-2 px-5 ml-2 text-white   rounded-full bg-blue-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring"
                                    aria-label="Record a voice">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
