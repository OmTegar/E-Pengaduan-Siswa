<button @click="open = !open;" type="button" aria-haspopup="true"
    :aria-expanded="open ? 'true' : 'false'"
    class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
    <span class="sr-only">User menu</span>
    @if (Auth::user()->avatar_url != null)
        <img class="w-10 h-10 rounded-full" src="{{ asset('storage/images/' . Auth::user()->avatar_url) }}"
            alt="{{ Auth::user()->name }}" />
    @else
        <img class="w-10 h-10 rounded-full" :src="generateAvatar('{{ Auth::user()->email }}')"
            alt="{{ Auth::user()->name }}" />
    @endif
</button>

<script>
    function generateAvatar(email) {
        const name = email.substring(0, 2); // ambil dua huruf pertama dari email
        const url = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&size=64&background=random`;
        return url;
    }
</script>

{{-- component --}}
