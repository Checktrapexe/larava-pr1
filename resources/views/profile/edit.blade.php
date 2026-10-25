<x-layout title="Profile">
    <main class="mx-auto max-w-3xl px-4 my-10 space-y-6">
        <h1 class="text-3xl font-extrabold text-orange-500">Profile</h1>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </main>
</x-layout>
