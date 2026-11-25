<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                {{ __('Dashboard') }}
            </h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Welcome back, :name', ['name' => Auth::user()->name]) }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 p-8 shadow-xl shadow-indigo-600/20 sm:p-10">
                <div class="pointer-events-none absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative">
                    <p class="text-sm font-semibold uppercase tracking-widest text-indigo-100">{{ __("You're all set") }}</p>
                    <h3 class="mt-2 text-2xl font-extrabold text-white sm:text-3xl">{{ __("You're logged in!") }}</h3>
                    <p class="mt-2 max-w-xl text-indigo-100">{{ __('Manage your products and account from the navigation above.') }}</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        @if (in_array(Auth::user()->role, ['admin', 'editor'], true))
                            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-indigo-700 shadow-sm transition hover:bg-indigo-50">
                                {{ __('Manage products') }}
                                <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/10 px-5 py-2.5 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                            {{ __('Edit profile') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <a href="{{ route('profile.edit') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900 dark:hover:shadow-black/40">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </span>
                    <h3 class="mt-4 text-lg font-bold text-slate-900 dark:text-white">{{ __('Your profile') }}</h3>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Update your name, email and password.') }}</p>
                </a>

                <a href="{{ route('home') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900 dark:hover:shadow-black/40">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                        </svg>
                    </span>
                    <h3 class="mt-4 text-lg font-bold text-slate-900 dark:text-white">{{ __('View storefront') }}</h3>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('See how your store looks to customers.') }}</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
