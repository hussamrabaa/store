<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800|cairo:400,500,600,700,800&display=swap" rel="stylesheet" />

        <x-theme-script />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .auth-mesh {
                background-image:
                    radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.22) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.18) 0px, transparent 45%),
                    radial-gradient(at 50% 100%, rgba(56, 189, 248, 0.16) 0px, transparent 50%);
            }
            .dark .auth-mesh {
                background-image:
                    radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.28) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.22) 0px, transparent 45%),
                    radial-gradient(at 50% 100%, rgba(56, 189, 248, 0.18) 0px, transparent 50%);
            }
        </style>
    </head>
    <body class="font-sans text-slate-700 dark:text-slate-300 antialiased auth-mesh bg-slate-50 dark:bg-slate-950">
        <div class="absolute end-4 top-4 flex items-center gap-2">
            <x-theme-toggle />
            <x-locale-switcher />
        </div>

        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">
            <a href="/" class="flex items-center gap-2.5">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 shadow-lg shadow-indigo-600/25">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12A1.125 1.125 0 0119.5 21.75h-15a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.764 7.5h12.472a1.125 1.125 0 011.12 1.007z" />
                    </svg>
                </span>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ config('app.name', 'Store') }}</span>
            </a>

            <div class="w-full sm:max-w-md mt-8 rounded-2xl border border-slate-200 bg-white px-6 py-8 shadow-xl shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/40 sm:px-8">
                {{ $slot }}
            </div>

            <a href="/" class="mt-8 text-sm font-medium text-slate-500 transition hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400">&larr; {{ __('Back to store') }}</a>
        </div>
    </body>
</html>
