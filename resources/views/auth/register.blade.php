<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Create your account') }}</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __('Join us to shop the collection and track your orders.') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Your full name') }}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1.5 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="{{ __('At least 8 characters') }}" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1.5 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="{{ __('Repeat your password') }}" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3">
            {{ __('Create account') }}
        </x-primary-button>

        <p class="text-center text-xs leading-relaxed text-slate-400 dark:text-slate-500">
            {{ __('By creating an account you agree to our terms of service and privacy policy.') }}
        </p>
    </form>

    <div class="mt-6 border-t border-slate-100 pt-6 text-center dark:border-slate-800">
        <p class="text-sm text-slate-500 dark:text-slate-400">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 transition hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                {{ __('Log in') }}
            </a>
        </p>
    </div>
</x-guest-layout>
