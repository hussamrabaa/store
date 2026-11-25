<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Users') }}</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Manage accounts and permissions.') }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                    <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300">
                    <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('ID') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Name') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Email') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Role') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Joined') }}</th>
                                <th class="px-6 py-3.5 text-end text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach ($users as $user)
                                <tr class="transition hover:bg-slate-50/70 dark:hover:bg-slate-800/40">
                                    <td class="px-6 py-4 text-slate-400 dark:text-slate-500">{{ $user->id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 text-xs font-bold uppercase text-white shadow-sm">
                                                {{ \Illuminate\Support\Str::of($user->name)->substr(0, 1) }}
                                            </span>
                                            <span class="font-semibold text-slate-900 dark:text-white">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if ($user->id === Auth::id())
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-100 px-2.5 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300">
                                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                                {{ ucfirst($user->role) }}
                                                <span class="font-normal text-indigo-500 dark:text-indigo-400">({{ __('You') }})</span>
                                            </span>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.role', $user) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" onchange="this.form.submit()"
                                                        aria-label="{{ __('Change role') }}"
                                                        class="rounded-lg border-slate-300 bg-white py-1.5 ps-3 pe-8 text-xs font-semibold text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200">
                                                    @foreach (['admin', 'editor', 'user'] as $role)
                                                        <option value="{{ $role }}" @selected($user->role === $role)>{{ ucfirst($role) }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400">{{ $user->created_at?->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="rounded-lg px-3 py-1.5 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-500/10">{{ __('Edit') }}</a>
                                            @if ($user->id !== Auth::id())
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                                      onsubmit="return confirm('{{ addslashes(__('Delete this user?')) }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="rounded-lg px-3 py-1.5 text-sm font-semibold text-red-600 transition hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
