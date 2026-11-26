<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - {{ config('app.name', 'Store') }}</title>

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
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fade-up 0.7s ease-out both; }
    </style>
</head>
<body class="font-sans text-slate-700 dark:text-slate-300 antialiased bg-white dark:bg-slate-950">
    <div id="bg-scene" class="pointer-events-none fixed inset-0 z-0" aria-hidden="true"></div>

    <div class="relative z-10 min-h-screen flex flex-col">
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
                    <a href="{{ route('home') }}#products" class="rounded-lg px-3.5 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">{{ __('Products') }}</a>
                    <a href="{{ route('home') }}#services" class="rounded-lg px-3.5 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">{{ __('Why us') }}</a>
                    <a href="{{ route('home') }}#contact" class="rounded-lg px-3.5 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">{{ __('Contact') }}</a>
                </div>

                <div class="flex items-center gap-2">
                    <x-theme-toggle />
                    <x-locale-switcher />
                </div>
            </nav>
        </header>

        <main class="flex-1">
            <div class="mesh border-b border-slate-100 dark:border-slate-800">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400" aria-label="Breadcrumb">
                        <a href="{{ route('home') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Home') }}</a>
                        <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                        <a href="{{ route('home') }}#products" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Products') }}</a>
                        <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                        <span class="truncate font-medium text-slate-700 dark:text-slate-200">{{ $product->name }}</span>
                    </nav>
                </div>
            </div>

            <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-16">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-start lg:gap-20">
                    <!-- Gallery -->
                    <div class="animate-fade-up" x-data="{ zoom: false }">
                        <div class="group relative">
                            <div class="pointer-events-none absolute -inset-4 rounded-[2.5rem] bg-gradient-to-tr from-indigo-500/20 via-violet-500/10 to-sky-400/20 blur-2xl"></div>

                            <div class="relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white shadow-2xl shadow-slate-900/10 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/40">
                                <div class="grid-pattern relative aspect-square w-full overflow-hidden">
                                    <span class="absolute start-5 top-5 z-10 inline-flex items-center gap-1.5 rounded-full bg-white/90 px-3 py-1.5 text-xs font-bold uppercase tracking-wide text-emerald-700 shadow-sm backdrop-blur dark:bg-slate-950/90 dark:text-emerald-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        {{ __('In stock') }}
                                    </span>

                                    @if ($product->image)
                                        <img src="{{ \Storage::disk('uploads')->url($product->image) }}" alt="{{ $product->name }}"
                                             @click="zoom = !zoom"
                                             :class="zoom ? 'scale-110 cursor-zoom-out' : 'scale-100 cursor-zoom-in'"
                                             class="h-full w-full object-contain p-8 transition-transform duration-500 sm:p-12">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400 dark:from-slate-800 dark:to-slate-700 dark:text-slate-500">
                                            <svg class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Floating badge -->
                            <div class="float-slow absolute -bottom-5 end-6 flex items-center gap-3 rounded-2xl border border-white/70 bg-white/90 p-3 pe-4 shadow-xl backdrop-blur dark:border-slate-700 dark:bg-slate-900/90">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ __('Authentic product') }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('Quality guaranteed') }}</p>
                                </div>
                            </div>
                        </div>

                        <p class="mt-8 flex items-center justify-center gap-2 text-xs text-slate-400 dark:text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.6-4.4a6 6 0 11-12 0 6 6 0 0112 0z" />
                            </svg>
                            {{ __('Tap the image to zoom in') }}
                        </p>
                    </div>

                    <!-- Details -->
                    <div class="animate-fade-up" style="animation-delay: 100ms;" x-data="{ qty: 1, saved: false }">
                        <div class="lg:sticky lg:top-24 lg:rounded-3xl lg:border lg:border-slate-200 lg:bg-white lg:p-8 lg:shadow-xl lg:shadow-slate-900/5 dark:lg:border-slate-800 dark:lg:bg-slate-900 dark:lg:shadow-black/40">
                            <span class="inline-flex items-center gap-2 rounded-full border border-indigo-200 bg-indigo-50 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-widest text-indigo-700 dark:border-indigo-500/30 dark:bg-indigo-500/10 dark:text-indigo-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                {{ __('Premium collection') }}
                            </span>

                            <h1 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight text-slate-900 dark:text-white sm:text-4xl lg:text-5xl">{{ $product->name }}</h1>

                            <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2">
                                <div class="flex items-center gap-1 text-amber-400">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                        </svg>
                                    @endfor
                                    <span class="ms-2 text-sm font-semibold text-slate-700 dark:text-slate-300">4.9</span>
                                </div>
                                <span class="text-sm text-slate-400 dark:text-slate-500">|</span>
                                <span class="text-sm text-slate-500 dark:text-slate-400">{{ __('128 reviews') }}</span>
                                <span class="text-sm text-slate-400 dark:text-slate-500">|</span>
                                <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    {{ __('Available now') }}
                                </span>
                            </div>

                            <div class="mt-6 flex flex-wrap items-end gap-3">
                                <span class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">${{ number_format((float) $product->price, 2) }}</span>
                                <span class="mb-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Tax included') }}</span>
                            </div>

                            <p class="mt-6 whitespace-pre-line text-base leading-relaxed text-slate-600 dark:text-slate-400">{{ $product->description }}</p>

                            <div class="mt-6 grid grid-cols-1 gap-2 sm:grid-cols-3">
                                <div class="flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-semibold text-slate-700 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
                                    <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>
                                    {{ __('Free shipping') }}
                                </div>
                                <div class="flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-semibold text-slate-700 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
                                    <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    {{ __('30-day returns') }}
                                </div>
                                <div class="flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-semibold text-slate-700 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
                                    <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                    {{ __('Secure checkout') }}
                                </div>
                            </div>

                            <div class="mt-8 flex flex-col gap-3 border-t border-slate-100 pt-6 dark:border-slate-800 sm:flex-row sm:items-center">
                                <div class="inline-flex items-center rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
                                    <button type="button" @click="qty = Math.max(1, qty - 1)"
                                            class="flex h-11 w-11 items-center justify-center rounded-s-xl text-slate-500 transition hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                                            aria-label="{{ __('Decrease quantity') }}">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" /></svg>
                                    </button>
                                    <input type="text" :value="qty" readonly
                                           class="h-11 w-12 border-0 bg-transparent p-0 text-center text-base font-bold text-slate-900 focus:ring-0 dark:text-white"
                                           aria-label="{{ __('Quantity') }}">
                                    <button type="button" @click="qty++"
                                            class="flex h-11 w-11 items-center justify-center rounded-e-xl text-slate-500 transition hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                                            aria-label="{{ __('Increase quantity') }}">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                    </button>
                                </div>

                                <a :href='"mailto:hello@example.com?subject=" + encodeURIComponent("Order: " + @js($product->name) + " x" + qty)'
                                   class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-indigo-600/25 transition hover:-translate-y-0.5 hover:shadow-indigo-600/40">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                    {{ __('Add to cart') }}
                                </a>

                                <button type="button" @click="saved = !saved"
                                        :class="saved ? 'border-rose-200 bg-rose-50 text-rose-600 dark:border-rose-500/30 dark:bg-rose-500/10 dark:text-rose-400' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800'"
                                        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border px-4 text-sm font-semibold shadow-sm transition"
                                        :aria-pressed="saved" aria-label="{{ __('Save to wishlist') }}">
                                    <svg class="h-5 w-5" :fill="saved ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                    <span x-text='saved ? @js(__("Saved")) : @js(__("Save"))'></span>
                                </button>
                            </div>

                            <a href="mailto:hello@example.com?subject={{ urlencode($product->name) }}"
                               class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                                {{ __('Ask a question about this item') }}
                            </a>

                            <div class="mt-6 flex items-center justify-center gap-4 text-xs font-medium text-slate-400 dark:text-slate-500">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ __('Verified seller') }}
                                </span>
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                    {{ __('Safe payment') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tabs -->
            <section class="border-t border-slate-100 dark:border-slate-800" x-data="{ tab: 'overview' }">
                <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                    <div class="flex gap-1 overflow-x-auto border-b border-slate-200 dark:border-slate-800">
                        <button type="button" @click="tab = 'overview'"
                                :class="tab === 'overview' ? 'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200'"
                                class="-mb-px whitespace-nowrap border-b-2 px-4 py-3 text-sm font-semibold transition">
                            {{ __('Overview') }}
                        </button>
                        <button type="button" @click="tab = 'shipping'"
                                :class="tab === 'shipping' ? 'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200'"
                                class="-mb-px whitespace-nowrap border-b-2 px-4 py-3 text-sm font-semibold transition">
                            {{ __('Shipping & returns') }}
                        </button>
                        <button type="button" @click="tab = 'details'"
                                :class="tab === 'details' ? 'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200'"
                                class="-mb-px whitespace-nowrap border-b-2 px-4 py-3 text-sm font-semibold transition">
                            {{ __('Details') }}
                        </button>
                    </div>

                    <div class="mt-8 max-w-3xl">
                        <div x-show="tab === 'overview'" x-cloak class="animate-fade-up">
                            <p class="whitespace-pre-line text-base leading-relaxed text-slate-600 dark:text-slate-400">{{ $product->description }}</p>
                        </div>

                        <div x-show="tab === 'shipping'" x-cloak class="animate-fade-up space-y-4">
                            <p class="text-base leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Orders are processed within 24 hours and typically arrive within 3–5 business days. Shipping is free on orders over $50.') }}</p>
                            <p class="text-base leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Not the right fit? Return any unused item within 30 days for a full refund — no questions asked.') }}</p>
                        </div>

                        <div x-show="tab === 'details'" x-cloak class="animate-fade-up">
                            <dl class="grid gap-3 sm:grid-cols-2">
                                <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm dark:border-slate-800 dark:bg-slate-900">
                                    <dt class="text-slate-500 dark:text-slate-400">{{ __('Price') }}</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white">${{ number_format((float) $product->price, 2) }}</dd>
                                </div>
                                <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm dark:border-slate-800 dark:bg-slate-900">
                                    <dt class="text-slate-500 dark:text-slate-400">{{ __('Availability') }}</dt>
                                    <dd class="font-semibold text-emerald-600 dark:text-emerald-400">{{ __('In stock') }}</dd>
                                </div>
                                <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm dark:border-slate-800 dark:bg-slate-900">
                                    <dt class="text-slate-500 dark:text-slate-400">{{ __('Product ID') }}</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white">#{{ $product->id }}</dd>
                                </div>
                                <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm dark:border-slate-800 dark:bg-slate-900">
                                    <dt class="text-slate-500 dark:text-slate-400">{{ __('Listed') }}</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white">{{ $product->created_at?->format('M d, Y') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </section>

            @if ($related->isNotEmpty())
                <section class="border-t border-slate-100 bg-slate-50/80 py-16 dark:border-slate-800 dark:bg-slate-900/80">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('You may also like') }}</span>
                                <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-3xl">{{ __('More products') }}</h2>
                            </div>
                            <a href="{{ route('home') }}#products" class="hidden text-sm font-semibold text-indigo-600 transition hover:text-indigo-500 dark:text-indigo-400 sm:inline-flex">{{ __('View all') }}</a>
                        </div>

                        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($related as $item)
                                <a href="{{ route('products.show', $item) }}"
                                   class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-800 dark:bg-slate-950 dark:hover:shadow-black/40">
                                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100 dark:bg-slate-800">
                                        @if ($item->image)
                                            <img src="{{ \Storage::disk('uploads')->url($item->image) }}" alt="{{ $item->name }}"
                                                 class="h-full w-full object-contain p-4 transition duration-500 group-hover:scale-105">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400 dark:from-slate-800 dark:to-slate-700 dark:text-slate-500">
                                                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-1 flex-col p-5">
                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $item->name }}</h3>
                                        <p class="mt-1.5 line-clamp-2 flex-1 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $item->description }}</p>
                                        <span class="mt-4 border-t border-slate-100 pt-4 text-xl font-extrabold text-slate-900 dark:border-slate-800 dark:text-white">${{ number_format((float) $item->price, 2) }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-200 bg-slate-50/85 dark:border-slate-800 dark:bg-slate-950/85">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-between gap-4 text-sm text-slate-500 dark:text-slate-500 sm:flex-row">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Store') }}. {{ __('All rights reserved.') }}</p>
                    <a href="{{ route('home') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Back to home') }}</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
