<div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
    <a href="{{ route('report.index') }}" role="menuitem"
        class="block p-2 text-sm text-white font-system-ui transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-gray-700">
        Semua Laporan
    </a>
    <a href="{{ route('report.unreadReport') }}" role="menuitem"
        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
        Laporan Belum Dibaca
    </a>
    <a href="#" role="menuitem"
        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
        Report Progressing
    </a>
    <a href="#" role="menuitem"
        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
        Report Done
    </a>
</div>
