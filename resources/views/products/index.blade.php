<x-storefront-layout :title="__('All products')">
    <!-- Page hero -->
    <section class="mesh border-b border-slate-100 dark:border-slate-800">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Home') }}</a>
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="font-medium text-slate-700 dark:text-slate-200">{{ __('All products') }}</span>
            </nav>

            <div class="mt-6 flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
                <div class="max-w-2xl animate-fade-up">
                    <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('Our collection') }}</span>
                    <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl">
                        {{ __('All products') }}
                    </h1>
                    <p class="mt-4 text-lg text-slate-600 dark:text-slate-400">{{ __('Browse every piece in our collection. Timeless style, fair prices, and quality made to last.') }}</p>
                </div>
                <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                    {{ $products->count() }} {{ __('items') }}
                </span>
            </div>
        </div>
    </section>

    <section class="bg-slate-50/80 py-12 dark:bg-slate-900/80 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" x-data="{ q: '', names: @js($products->pluck('name')->map(fn ($name) => \Illuminate\Support\Str::lower($name))->values()) }">
            <!-- Toolbar -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <label class="relative block w-full max-w-md">
                    <span class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-4 text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.6-4.4a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </span>
                    <input x-model="q" type="search" placeholder="{{ __('Search products...') }}"
                           class="h-12 w-full rounded-xl border border-slate-200 bg-white ps-11 pe-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                </label>

                <a href="{{ route('pages.why-us') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                    {{ __('Why choose us') }}
                    <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            @if ($products->isEmpty())
                <div class="mt-12 flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center dark:border-slate-700 dark:bg-slate-950">
                    <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12A1.125 1.125 0 0119.5 21.75h-15a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.764 7.5h12.472a1.125 1.125 0 011.12 1.007z" />
                        </svg>
                    </span>
                    <h3 class="mt-5 text-xl font-bold text-slate-900 dark:text-white">{{ __('No products yet') }}</h3>
                    <p class="mt-2 max-w-sm text-slate-600 dark:text-slate-400">{{ __('Our collection is being prepared. Please check back soon for new arrivals.') }}</p>
                </div>
            @else
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($products as $product)
                        <article x-data="{ added: false }"
                                 x-show="q === '' || @js(\Illuminate\Support\Str::lower($product->name)).includes(q.toLowerCase())"
                                 class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-800 dark:bg-slate-950 dark:hover:shadow-black/40">
                            <div class="relative aspect-[4/3] overflow-hidden bg-slate-100 dark:bg-slate-800">
                                <a href="{{ route('products.show', $product) }}" class="block h-full w-full">
                                    @if ($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                             class="h-full w-full object-contain p-4 transition duration-500 group-hover:scale-105">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400 dark:from-slate-800 dark:to-slate-700 dark:text-slate-500">
                                            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                </a>
                                <span class="absolute start-3 top-3 inline-flex items-center gap-1.5 rounded-full bg-white/90 px-2.5 py-1 text-xs font-semibold text-emerald-700 shadow-sm backdrop-blur dark:bg-slate-900/90 dark:text-emerald-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    {{ __('In stock') }}
                                </span>
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <a href="{{ route('products.show', $product) }}" class="text-lg font-bold text-slate-900 transition hover:text-indigo-600 dark:text-white dark:hover:text-indigo-400">{{ $product->name }}</a>
                                <p class="mt-1.5 line-clamp-2 flex-1 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $product->description }}</p>
                                <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4 dark:border-slate-800">
                                    <span class="text-xl font-extrabold text-slate-900 dark:text-white">${{ number_format((float) $product->price, 2) }}</span>
                                    <a href="{{ route('products.show', $product) }}" class="text-xs font-semibold text-indigo-600 transition hover:text-indigo-500 dark:text-indigo-400">{{ __('Details') }}</a>
                                </div>
                                <button type="button"
                                        @click="$store.cart.add({ id: {{ $product->id }}, name: @js($product->name), price: {{ (float) $product->price }}, image: @js($product->image ? asset($product->image) : null) }); added = true; setTimeout(() => added = false, 1500)"
                                        class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:shadow-indigo-600/40 hover:brightness-110">
                                    <svg x-show="!added" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                    <svg x-show="added" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    <span x-text="added ? @js(__('Added to cart')) : @js(__('Add to cart'))"></span>
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div x-show="q !== '' && !names.some(n => n.includes(q.toLowerCase()))" x-cloak class="mt-12 rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center dark:border-slate-700 dark:bg-slate-950">
                    <p class="text-slate-600 dark:text-slate-400">{{ __('No products match your search.') }}</p>
                </div>
            @endif
        </div>
    </section>
</x-storefront-layout>
