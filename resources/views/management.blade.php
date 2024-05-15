<x-app-layout>
    <!-- Page mother -->
    <div class="px-3 py-2 sm:px-6 sm:py-4 md:p-4 mb-5">
        <h1 class="font-semibold text-2xl md:text-3xl mb-2 font-system-ui capitalize">
            {{ __('Menejemen Pengguna') }}
        </h1>
        <p class="text-sm mb-4 text-gray-400 dark:text-gray-400 font-system-ui">
            {{ __('Daftar seluruh data pengguna aplikasi') }}</p>
        @include('components.alerts')
        <div class="border-b border-gray-300 my-5"></div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-[#0c2d54] dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Posisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $User)
                        <tr class="bg-white border-b dark:bg-[#0a2647] dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $User->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $User->email }}
                            </td>
                            <form action="{{ route('management.updateRole', $User) }}" method="post">
                                @csrf
                                <td class="px-6 py-4">
                                    <select name="role_id" id="role_id"
                                        class="bg-gray-200 rounded p-1 text-sm dark:bg-darker">
                                        <option value="1" {{ $User->role_id == 1 ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="2" {{ $User->role_id == 2 ? 'selected' : '' }}>Guru</option>
                                        <option value="3" {{ $User->role_id == 3 ? 'selected' : '' }}>Siswa
                                        </option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 flex gap-1">
                                    <button type="submit" onclick="return confirm('Anda yakin simpan data ini?')"
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan</button>
                            </form>
                            <form action="{{ route('management.delete', $User) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Anda yakin hapus data ini?')"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-2 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-3"
                aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing
                    <span class="font-semibold text-gray-900">{{ $users->firstItem() }}</span> to <span
                        class="font-semibold text-gray-900">{{ $users->lastItem() }}</span> of <span
                        class="font-semibold text-gray-900">{{ $users->total() }}</span>
                </span>
                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    <li>
                        <a href="{{ $users->previousPageUrl() }}"
                            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                    </li>
                    @foreach ($users->getUrlRange($users->currentPage() - 1, $users->currentPage() + 1) as $num => $url)
                        <li>
                            {{-- PAGINATATE ACTIVE URL  ( help ndak roh kelas e ) --}}
                            <a href="{{ $url }}"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 {{ $num == $users->currentPage() ? 'active' : '' }} hover:bg-gray-100 hover:text-gray-700">{{ $num }}</a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ $users->nextPageUrl() }}"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</x-app-layout>
