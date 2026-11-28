<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title.' - '.config('app.name', 'Store') : config('app.name', 'Store') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800|cairo:400,500,600,700,800&display=swap" rel="stylesheet" />

    <x-theme-script />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        .mesh {
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.16) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.14) 0px, transparent 45%),
                radial-gradient(at 50% 100%, rgba(56, 189, 248, 0.12) 0px, transparent 50%);
        }
        .dark .mesh {
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.25) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.2) 0px, transparent 45%),
                radial-gradient(at 50% 100%, rgba(56, 189, 248, 0.16) 0px, transparent 50%);
        }
        .text-gradient {
            background-image: linear-gradient(90deg, #4f46e5, #7c3aed, #0ea5e9);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .dark .text-gradient {
            background-image: linear-gradient(90deg, #818cf8, #a78bfa, #38bdf8);
        }
        .grid-pattern {
            background-image:
                linear-gradient(to right, rgba(148, 163, 184, 0.12) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, 0.12) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .float-slow { animation: float 6s ease-in-out infinite; }
        .float-slower { animation: float 8s ease-in-out infinite; }
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fade-up 0.7s ease-out both; }
    </style>
</head>
<body class="font-sans text-slate-700 antialiased bg-white dark:bg-slate-950 dark:text-slate-300">
    <div id="bg-scene" class="pointer-events-none fixed inset-0 z-0" aria-hidden="true"></div>

    <div x-data="{ open: false }" class="relative z-10 min-h-screen flex flex-col">
        <!-- Announcement -->
        <div class="bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 px-4 py-2 text-center text-xs font-semibold tracking-wide text-white sm:text-sm">
            {{ __('Free shipping on all orders over $50 — 30-day easy returns') }}
        </div>

        <!-- Header -->
        <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/80 backdrop-blur-xl dark:border-slate-800/70 dark:bg-slate-950/80">
            <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 shadow-lg shadow-indigo-600/25">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12A1.125 1.125 0 0119.5 21.75h-15a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.764 7.5h12.472a1.125 1.125 0 011.12 1.007z" />
                        </svg>
                    </span>
                    <span class="text-lg font-extrabold tracking-tight text-slate-900 dark:text-white">{{ config('app.name', 'Store') }}</span>
                </a>

                <div class="hidden items-center gap-1 md:flex">
                    <a href="{{ route('home') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' }}">{{ __('Home') }}</a>
                    <a href="{{ route('pages.why-us') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium transition {{ request()->routeIs('pages.why-us') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' }}">{{ __('Why us') }}</a>
                    <a href="{{ route('products.index') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium transition {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' }}">{{ __('Products') }}</a>
                    <a href="{{ route('pages.contact') }}" class="rounded-lg px-3.5 py-2 text-sm font-medium transition {{ request()->routeIs('pages.contact') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' }}">{{ __('Contact') }}</a>
                </div>

                <div class="hidden items-center gap-2 md:flex">
                    <x-theme-toggle />
                    <x-locale-switcher />

                    <x-cart-preview />

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:shadow-indigo-600/40 hover:brightness-110">
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">{{ __('Log in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:shadow-indigo-600/40 hover:brightness-110">
                                {{ __('Get started') }}
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center gap-2 md:hidden">
                    <x-cart-preview />
                    <button @click="open = !open" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800">
                        <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </nav>

            <!-- Mobile menu -->
            <div x-show="open" x-cloak x-transition class="border-t border-slate-200 bg-white px-4 pb-5 pt-3 dark:border-slate-800 dark:bg-slate-950 md:hidden">
                <div class="flex flex-col gap-1">
                    <a href="{{ route('home') }}" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Home') }}</a>
                    <a href="{{ route('pages.why-us') }}" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Why us') }}</a>
                    <a href="{{ route('products.index') }}" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Products') }}</a>
                    <a href="{{ route('pages.contact') }}" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Contact') }}</a>
                    <a href="{{ route('cart.index') }}" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Cart') }}</a>
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <x-theme-toggle />
                    <x-locale-switcher />
                </div>

                <div class="mt-4 flex flex-col gap-2 border-t border-slate-200 pt-4 dark:border-slate-800">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-center text-sm font-semibold text-white">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-xl border border-slate-200 px-4 py-2.5 text-center text-sm font-semibold text-slate-700 dark:border-slate-700 dark:text-slate-200">{{ __('Log in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-center text-sm font-semibold text-white">{{ __('Get started') }}</a>
                        @endif
                    @endauth
                </div>
            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-200 bg-slate-50/85 dark:border-slate-800 dark:bg-slate-950/85">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
                    <div class="max-w-sm">
                        <div class="flex items-center gap-2.5">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 shadow-lg shadow-indigo-600/25">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12A1.125 1.125 0 0119.5 21.75h-15a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.764 7.5h12.472a1.125 1.125 0 011.12 1.007z" />
                                </svg>
                            </span>
                            <span class="text-lg font-extrabold tracking-tight text-slate-900 dark:text-white">{{ config('app.name', 'Store') }}</span>
                        </div>
                        <p class="mt-4 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Quality essentials, thoughtfully designed and delivered with care.') }}</p>
                    </div>

                    <div class="flex flex-wrap gap-x-12 gap-y-6">
                        <div>
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('Shop') }}</h4>
                            <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                                <li><a href="{{ route('products.index') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('All products') }}</a></li>
                                <li><a href="{{ route('pages.why-us') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Why us') }}</a></li>
                                <li><a href="{{ route('cart.index') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Cart') }}</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('Company') }}</h4>
                            <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                                <li><a href="{{ route('pages.why-us') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('About') }}</a></li>
                                <li><a href="{{ route('pages.contact') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Contact') }}</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('Account') }}</h4>
                            <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                                @auth
                                    <li><a href="{{ route('dashboard') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Dashboard') }}</a></li>
                                @else
                                    <li><a href="{{ route('login') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Log in') }}</a></li>
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Register') }}</a></li>
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-col items-center justify-between gap-4 border-t border-slate-200 pt-8 text-sm text-slate-500 dark:border-slate-800 dark:text-slate-500 sm:flex-row">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Store') }}. {{ __('All rights reserved.') }}</p>
                    <p>{{ __('Made with care.') }}</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
