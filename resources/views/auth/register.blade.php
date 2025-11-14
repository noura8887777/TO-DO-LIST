<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6">
            {{ __('Register') }}
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" class="block text-gray-700 dark:text-gray-200 mb-1" />
                <x-text-input id="name" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="block text-gray-700 dark:text-gray-200 mb-1" />
                <x-text-input id="email" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="block text-gray-700 dark:text-gray-200 mb-1" />
                <x-text-input id="password" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-gray-700 dark:text-gray-200 mb-1" />
                <x-text-input id="password_confirmation" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Role -->
            <div class="mb-4">
                <x-input-label for="role" :value="__('Role')" class="block text-gray-700 dark:text-gray-200 mb-1" />
                <select id="role" name="role" required class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <option value="" disabled selected>Choisir un rôle</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 underline" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4 px-6 py-2">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
