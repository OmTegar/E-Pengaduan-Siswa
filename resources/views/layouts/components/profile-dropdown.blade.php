<div x-show="open" x-transition:enter="transition-all transform ease-out"
    x-transition:enter-start="translate-y-1/2 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition-all transform ease-in" x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
    class="absolute right-0 w-48 py-1 origin-top-right bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark"
    role="menu" aria-orientation="vertical" aria-label="User menu">
    <a href="{{ route('profile.edit') }}" role="menuitem"
        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-blue-600">
        Your Profile
    </a>
    <a href="{{ route('home') }}" role="menuitem"
        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-blue-600">
        Home
    </a>
    {{-- <a href="#" role="menuitem"
        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-blue-600">
        Settings
    </a> --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" role="menuitem" onclick="event.preventDefault(); this.closest('form').submit();"
            class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-blue-600">
            Logout
        </a>
    </form>
</div>
