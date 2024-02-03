<x-app-layout>
    <!-- Page mother -->
    <div class="flex items-center justify-center flex-1 p-4">

        <!-- Page wrapper -->
        <div class="w-full grid md:flex sm:flex flex-col md:flex-row sm:flex-row gap-6">
            <div class="flex flex-col lg:w-2/5 md:w-1/2 sm:w-1/2 gap-6">
                <div class="h-auto p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded items-center justify-center overflow-hidden rounded-2xl">
                    <div class="max-w-full">
                        <div class="h-24 dark:bg-teal-400"></div>
                        <div class="-mt-20 flex justify-center">
                            @include('layouts.components.avatar-32')
                        </div>
                        <div class="mt-5 mb-1 px-3 text-center">
                            <p class="text-xl font-serif font-medium">
                                {{ $user->name }}
                            </p>
                        </div>
                        <div class="mb-5 px-3 text-center text-sky-500">
                            <p class="text-sm font-serif font-light">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="h-auto p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-w-full">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <div class="lg:w-3/5 md:w-1/2 sm:w-1/2 flex flex-col gap-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-full">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-full">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
