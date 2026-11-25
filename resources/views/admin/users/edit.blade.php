<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Edit user') }}</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Update account details and role.') }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1.5 block w-full"
                                      :value="old('name', $user->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1.5 block w-full"
                                      :value="old('email', $user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="role" :value="__('Role')" />
                        <select id="role" name="role"
                                class="mt-1.5 block w-full border-slate-300 bg-white text-slate-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            @foreach (['admin', 'editor', 'user'] as $role)
                                <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3 border-t border-slate-100 pt-5 dark:border-slate-800">
                        <x-primary-button>{{ __('Save changes') }}</x-primary-button>
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-slate-500 transition hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
