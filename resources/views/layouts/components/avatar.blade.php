{{-- <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })" type="button" aria-haspopup="true"
    :aria-expanded="open ? 'true' : 'false'"
    class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
    <span class="sr-only">User menu</span>
    <img class="w-10 h-10 rounded-full"
        src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
        alt="Ahmed Kamel" />
</button> --}}
@if (Auth::user()->avatar_url != null)
    <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })" type="button"
        aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
        class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
        <span class="sr-only">User menu</span>
        <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . Auth::user()->avatar) }}"
            alt="{{ Auth::user()->name }}" />
    </button>
@else
    <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })" type="button"
        aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
        class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
        <span class="sr-only">User menu</span>
        <img class="w-10 h-10 rounded-full" :src="generateAvatar('{{ Auth::user()->email }}')"
            alt="{{ Auth::user()->name }}" />
    </button>
@endif


<script>
    function generateAvatar(email) {
        const name = email.substring(0, 2); // ambil dua huruf pertama dari email
        const url = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&size=64&background=random`;
        return url;
    }
</script>
