<div class="flex flex-col items-center">
    <button
        class="transition-opacity duration-200 rounded-lg dark:opacity-85 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100"
        id="uploadButton">
        <span class="sr-only">User menu</span>
        @if (Auth::user()->avatar_url != null)
            <img class="w-32 h-32 rounded-lg" id="previewAvatar"
                src="{{ asset('storage/images/' . Auth::user()->avatar_url) }}" alt="{{ Auth::user()->name }}" />
        @else
            <img class="w-32 h-32 rounded-lg" id="previewAvatar" :src="generateAvatar('{{ Auth::user()->email }}')"
                alt="{{ Auth::user()->name }}" />
        @endif
    </button>

    @if (session('status') === 'avatar-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Avatar Updated.') }}</p>
    @endif

    <form action="{{ route('profile.update-avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
        @csrf
        <input type="file" id="imageInput" name="avatar" class="hidden" accept="image/*" />
        <input type="text" id="user_id" name="user_id" class="hidden" value="{{ Auth::user()->id }}">
        <x-primary-button class="hidden mt-3" id="submitButton">{{ __('Update Avatar') }}</x-primary-button>
    </form>
</div>

<script>
    function generateAvatar(email) {
        const name = email.substring(0, 2);
        const url = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&size=64&background=random`;
        return url;
    }

    document.getElementById('uploadButton').addEventListener('click', function() {
        document.getElementById('imageInput').click();
    });

    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewAvatar').src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Tampilkan tombol submit setelah memilih file
            document.getElementById('submitButton').classList.remove('hidden');
        }
    });

    // event listener untuk submit form ketika tombol submit ditekan
    document.getElementById('submitButton').addEventListener('click', function() {
        document.getElementById('avatarForm').submit();
    });
</script>
