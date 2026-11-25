<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-slate-200 bg-white/80 backdrop-blur-xl dark:border-slate-800 dark:bg-slate-950/80">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 shadow-lg shadow-indigo-600/25">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12A1.125 1.125 0 0119.5 21.75h-15a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.764 7.5h12.472a1.125 1.125 0 011.12 1.007z" />
                        </svg>
                    </span>
                    <span class="text-lg font-extrabold tracking-tight text-slate-900 dark:text-white">{{ config('app.name', 'Store') }}</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden items-center gap-1 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('home')">
                        <span class="inline-flex items-center gap-1.5">
                            {{ __('View store') }}
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </span>
                    </x-nav-link>
                    @if (in_array(Auth::user()->role, ['admin', 'editor'], true))
                        <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')">
                            {{ __('Products') }}
                        </x-nav-link>
                    @endif
                    @if (Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            {{ __('Users') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right side: toggles + settings -->
            <div class="hidden sm:flex sm:items-center sm:gap-2">
                <x-theme-toggle />
                <x-locale-switcher />

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2.5 rounded-xl px-2 py-1.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100 focus:outline-none dark:text-slate-300 dark:hover:bg-slate-800">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 text-xs font-bold uppercase text-white shadow-sm">
                                {{ \Illuminate\Support\Str::of(Auth::user()->name)->substr(0, 1) }}
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-b border-slate-100 px-4 py-3 dark:border-slate-800">
                            <p class="truncate text-sm font-semibold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="truncate text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center gap-2 sm:hidden">
                <x-theme-toggle />
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out dark:hover:bg-slate-800 dark:hover:text-slate-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')">
                {{ __('View store') }}
            </x-responsive-nav-link>
            @if (in_array(Auth::user()->role, ['admin', 'editor'], true))
                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')">
                    {{ __('Products') }}
                </x-responsive-nav-link>
            @endif
            @if (Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-2 border-t border-slate-200 dark:border-slate-800">
            <div class="flex items-center justify-between gap-3 px-4">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 text-sm font-bold uppercase text-white shadow-sm">
                        {{ \Illuminate\Support\Str::of(Auth::user()->name)->substr(0, 1) }}
                    </span>
                    <div>
                        <div class="font-semibold text-base text-slate-900 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <x-locale-switcher />
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
