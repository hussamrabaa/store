<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Store') }}</title>

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
<body class="font-sans text-slate-700 dark:text-slate-300 antialiased bg-white dark:bg-slate-950">
    <div id="bg-scene" class="pointer-events-none fixed inset-0 z-0" aria-hidden="true"></div>

    <div x-data="{ open: false }" class="relative z-10 min-h-screen flex flex-col">
        <!-- Header -->
        <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/80 backdrop-blur-xl dark:border-slate-800/70 dark:bg-slate-950/80">
            <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                <a href="#home" class="flex items-center gap-2.5">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 shadow-lg shadow-indigo-600/25">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12A1.125 1.125 0 0119.5 21.75h-15a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.764 7.5h12.472a1.125 1.125 0 011.12 1.007z" />
                        </svg>
                    </span>
                    <span class="text-lg font-extrabold tracking-tight text-slate-900 dark:text-white">{{ config('app.name', 'Store') }}</span>
                </a>

                <div class="hidden items-center gap-1 md:flex">
                    <a href="#home" class="rounded-lg px-3.5 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">{{ __('Home') }}</a>
                    <a href="#services" class="rounded-lg px-3.5 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">{{ __('Why us') }}</a>
                    <a href="#products" class="rounded-lg px-3.5 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">{{ __('Products') }}</a>
                    <a href="#contact" class="rounded-lg px-3.5 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">{{ __('Contact') }}</a>
                </div>

                <div class="hidden items-center gap-2 md:flex">
                    <x-theme-toggle />
                    <x-locale-switcher />

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:shadow-indigo-600/40 hover:brightness-110">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">{{ __('Log in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:shadow-indigo-600/40 hover:brightness-110">
                                {{ __('Get started') }}
                                <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <button @click="open = !open" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 md:hidden">
                    <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </nav>

            <!-- Mobile menu -->
            <div x-show="open" x-cloak x-transition class="border-t border-slate-200 bg-white px-4 pb-5 pt-3 dark:border-slate-800 dark:bg-slate-950 md:hidden">
                <div class="flex flex-col gap-1">
                    <a href="#home" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Home') }}</a>
                    <a href="#services" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Why us') }}</a>
                    <a href="#products" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Products') }}</a>
                    <a href="#contact" @click="open = false" class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">{{ __('Contact') }}</a>
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
            <!-- Hero -->
            <section id="home" class="mesh relative overflow-hidden">
                <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:gap-8 lg:px-8 lg:py-24">
                    <div class="animate-fade-up">
                        <span class="inline-flex items-center gap-2 rounded-full border border-indigo-200 bg-white/70 px-3.5 py-1.5 text-xs font-semibold text-indigo-700 shadow-sm backdrop-blur dark:border-indigo-500/30 dark:bg-slate-900/70 dark:text-indigo-300">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-indigo-600"></span>
                            </span>
                            {{ __('New season · 2026 collection') }}
                        </span>

                        <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-slate-900 dark:text-white sm:text-5xl lg:text-6xl">
                            {{ __('Everyday essentials,') }}<br class="hidden sm:block">
                            <span class="text-gradient">{{ __('thoughtfully designed.') }}</span>
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                            {{ __('Discover a curated collection of quality pieces made to last. Timeless style, fair prices, and a shopping experience built around you.') }}
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                            <a href="#products" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-indigo-600/25 transition hover:-translate-y-0.5 hover:shadow-indigo-600/40">
                                {{ __('Shop the collection') }}
                                <svg class="h-5 w-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                            <a href="#services" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-base font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                                {{ __('Why choose us') }}
                            </a>
                        </div>

                        <dl class="mt-12 grid max-w-md grid-cols-3 gap-6">
                            <div>
                                <dt class="text-sm text-slate-500 dark:text-slate-400">{{ __('Happy customers') }}</dt>
                                <dd class="mt-1 text-2xl font-extrabold text-slate-900 dark:text-white">12k+</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-slate-500 dark:text-slate-400">{{ __('Products') }}</dt>
                                <dd class="mt-1 text-2xl font-extrabold text-slate-900 dark:text-white">{{ $products->count() ?: '150' }}+</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-slate-500 dark:text-slate-400">{{ __('Avg. rating') }}</dt>
                                <dd class="mt-1 flex items-center gap-1 text-2xl font-extrabold text-slate-900 dark:text-white">
                                    4.9
                                    <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                    </svg>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="relative animate-fade-up lg:justify-self-end" style="animation-delay: 120ms;">
                        <div class="relative mx-auto max-w-md lg:max-w-lg">
                            <div class="absolute -inset-4 rounded-[2rem] bg-gradient-to-tr from-indigo-500/20 via-violet-500/10 to-sky-400/20 blur-2xl"></div>
                            <div class="relative overflow-hidden rounded-[1.75rem] border border-white/60 bg-white p-2 shadow-2xl shadow-slate-900/10 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/40">
                                <img src="{{ asset('images/hero-img.png') }}" alt="Featured collection"
                                     class="h-[26rem] w-full rounded-[1.35rem] object-cover sm:h-[30rem]">
                            </div>

                            <div class="float-slow absolute -left-4 top-8 flex items-center gap-3 rounded-2xl border border-white/70 bg-white/90 p-3 pe-4 shadow-xl backdrop-blur dark:border-slate-700 dark:bg-slate-900/90 sm:-left-8">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ __('Free shipping') }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('On orders over $50') }}</p>
                                </div>
                            </div>

                            <div class="float-slower absolute -right-3 bottom-10 flex items-center gap-3 rounded-2xl border border-white/70 bg-white/90 p-3 pe-4 shadow-xl backdrop-blur dark:border-slate-700 dark:bg-slate-900/90 sm:-right-6">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ __('Quality assured') }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('30-day returns') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features -->
            <section id="services" class="border-t border-slate-100 bg-white/80 py-16 dark:border-slate-800 dark:bg-slate-950/80 sm:py-24">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('Why choose us') }}</span>
                        <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Built around a better experience') }}</h2>
                        <p class="mt-4 text-lg text-slate-600 dark:text-slate-400">{{ __('Everything we do is designed to make shopping simple, reliable, and genuinely enjoyable.') }}</p>
                    </div>

                    <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @php
                            $features = [
                                ['title' => __('Fast delivery'), 'desc' => __('Orders ship within 24 hours, straight to your door.'), 'icon' => 'M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12', 'color' => 'from-sky-500 to-indigo-500', 'bg' => 'bg-sky-50 text-sky-600 dark:bg-sky-500/15 dark:text-sky-400'],
                                ['title' => __('Premium quality'), 'desc' => __('Carefully sourced materials that are made to last.'), 'icon' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z', 'color' => 'from-amber-400 to-orange-500', 'bg' => 'bg-amber-50 text-amber-600 dark:bg-amber-500/15 dark:text-amber-400'],
                                ['title' => __('Secure payments'), 'desc' => __('Checkout with confidence using encrypted payments.'), 'icon' => 'M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z', 'color' => 'from-emerald-400 to-teal-500', 'bg' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400'],
                                ['title' => __('Real support'), 'desc' => __('A friendly team ready to help, whenever you need.'), 'icon' => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155', 'color' => 'from-violet-500 to-fuchsia-500', 'bg' => 'bg-violet-50 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400'],
                            ];
                        @endphp

                        @foreach ($features as $feature)
                            <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-transparent hover:shadow-xl dark:border-slate-800 dark:bg-slate-900 dark:hover:shadow-black/40">
                                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r {{ $feature['color'] }} opacity-0 transition group-hover:opacity-100"></div>
                                <span class="flex h-12 w-12 items-center justify-center rounded-xl {{ $feature['bg'] }}">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}" />
                                    </svg>
                                </span>
                                <h3 class="mt-5 text-lg font-bold text-slate-900 dark:text-white">{{ $feature['title'] }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $feature['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Products -->
            <section id="products" class="bg-slate-50/80 py-16 dark:bg-slate-900/80 sm:py-24">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
                        <div>
                            <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('Our collection') }}</span>
                            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Featured products') }}</h2>
                            <p class="mt-3 max-w-xl text-lg text-slate-600 dark:text-slate-400">{{ __('Handpicked favorites from our latest drop.') }}</p>
                        </div>
                        <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                            {{ $products->count() }} {{ __('items') }}
                        </span>
                    </div>

                    @if ($products->isEmpty())
                        <div class="mt-14 flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center dark:border-slate-700 dark:bg-slate-950">
                            <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12A1.125 1.125 0 0119.5 21.75h-15a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.764 7.5h12.472a1.125 1.125 0 011.12 1.007z" />
                                </svg>
                            </span>
                            <h3 class="mt-5 text-xl font-bold text-slate-900 dark:text-white">{{ __('No products yet') }}</h3>
                            <p class="mt-2 max-w-sm text-slate-600 dark:text-slate-400">{{ __('Our collection is being prepared. Please check back soon for new arrivals.') }}</p>
                        </div>
                    @else
                        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($products as $product)
                                <a href="{{ route('products.show', $product) }}"
                                   class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-800 dark:bg-slate-950 dark:hover:shadow-black/40">
                                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100 dark:bg-slate-800">
                                        @if ($product->image)
                                            <img src="{{ \Storage::disk('uploads')->url($product->image) }}" alt="{{ $product->name }}"
                                                 class="h-full w-full object-contain p-4 transition duration-500 group-hover:scale-105">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400 dark:from-slate-800 dark:to-slate-700 dark:text-slate-500">
                                                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <span class="absolute start-3 top-3 inline-flex items-center gap-1.5 rounded-full bg-white/90 px-2.5 py-1 text-xs font-semibold text-emerald-700 shadow-sm backdrop-blur dark:bg-slate-900/90 dark:text-emerald-400">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            {{ __('In stock') }}
                                        </span>
                                    </div>
                                    <div class="flex flex-1 flex-col p-5">
                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $product->name }}</h3>
                                        <p class="mt-1.5 line-clamp-2 flex-1 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $product->description }}</p>
                                        <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4 dark:border-slate-800">
                                            <span class="text-xl font-extrabold text-slate-900 dark:text-white">${{ number_format((float) $product->price, 2) }}</span>
                                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                {{ __('Available') }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

            <!-- Contact -->
            <section id="contact" class="bg-white/80 py-16 dark:bg-slate-950/80 sm:py-24">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 px-6 py-16 text-center shadow-2xl shadow-indigo-600/25 sm:px-16">
                        <div class="pointer-events-none absolute -left-16 -top-16 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
                        <div class="pointer-events-none absolute -bottom-24 -right-10 h-72 w-72 rounded-full bg-white/10 blur-2xl"></div>
                        <div class="relative">
                            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">{{ __("Have a question? Let's talk.") }}</h2>
                            <p class="mx-auto mt-4 max-w-xl text-lg text-indigo-100">{{ __('Our team is here to help with sizing, orders, or anything else. We usually reply within one business day.') }}</p>
                            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                                <a href="mailto:hello@example.com" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3.5 text-base font-semibold text-indigo-700 shadow-lg transition hover:-translate-y-0.5 hover:bg-indigo-50">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                    {{ __('Email us') }}
                                </a>
                                <a href="#products" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/30 bg-white/10 px-6 py-3.5 text-base font-semibold text-white backdrop-blur transition hover:bg-white/20">
                                    {{ __('Browse products') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer id="about" class="border-t border-slate-200 bg-slate-50/85 dark:border-slate-800 dark:bg-slate-950/85">
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
                                <li><a href="#products" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('All products') }}</a></li>
                                <li><a href="#services" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Why us') }}</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('Company') }}</h4>
                            <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                                <li><a href="#about" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('About') }}</a></li>
                                <li><a href="#contact" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Contact') }}</a></li>
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
