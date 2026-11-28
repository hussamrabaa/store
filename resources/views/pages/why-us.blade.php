<x-storefront-layout :title="__('Why us')">
    <!-- Hero -->
    <section class="mesh relative overflow-hidden border-b border-slate-100 dark:border-slate-800">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div class="animate-fade-up">
                <span class="inline-flex items-center gap-2 rounded-full border border-indigo-200 bg-white/70 px-3.5 py-1.5 text-xs font-semibold text-indigo-700 shadow-sm backdrop-blur dark:border-indigo-500/30 dark:bg-slate-900/70 dark:text-indigo-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                    {{ __('Why choose us') }}
                </span>
                <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-slate-900 dark:text-white sm:text-5xl lg:text-6xl">
                    {{ __('Shopping that puts') }}<br class="hidden sm:block">
                    <span class="text-gradient">{{ __('you first.') }}</span>
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                    {{ __('We built this store around a simple idea: great products, honest prices, and a team that actually cares. Here is what makes the difference.') }}
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-indigo-600/25 transition hover:-translate-y-0.5 hover:shadow-indigo-600/40">
                        {{ __('Shop the collection') }}
                        <svg class="h-5 w-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('pages.contact') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-base font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                        {{ __('Talk to us') }}
                    </a>
                </div>
            </div>

            <div class="relative animate-fade-up" style="animation-delay: 120ms;">
                <div class="relative mx-auto max-w-md lg:max-w-lg">
                    <div class="absolute -inset-4 rounded-[2rem] bg-gradient-to-tr from-indigo-500/20 via-violet-500/10 to-sky-400/20 blur-2xl"></div>
                    <div class="relative overflow-hidden rounded-[1.75rem] border border-white/60 bg-white p-2 shadow-2xl shadow-slate-900/10 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/40">
                        <img src="{{ asset('images/hero-img.png') }}" alt="{{ __('Our promise') }}" class="h-[24rem] w-full rounded-[1.35rem] object-cover sm:h-[28rem]">
                    </div>
                    <div class="float-slow absolute -left-4 top-8 flex items-center gap-3 rounded-2xl border border-white/70 bg-white/90 p-3 pe-4 shadow-xl backdrop-blur dark:border-slate-700 dark:bg-slate-900/90 sm:-left-8">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400">
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

    <!-- Stats -->
    <section class="border-b border-slate-100 bg-white/80 py-12 dark:border-slate-800 dark:bg-slate-950/80">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 px-4 sm:px-6 lg:grid-cols-4 lg:px-8">
            @php
                $stats = [
                    ['value' => '12k+', 'label' => __('Happy customers')],
                    ['value' => '150+', 'label' => __('Products')],
                    ['value' => '4.9/5', 'label' => __('Avg. rating')],
                    ['value' => '24h', 'label' => __('Fast dispatch')],
                ];
            @endphp
            @foreach ($stats as $stat)
                <div class="text-center">
                    <p class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ $stat['value'] }}</p>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Values -->
    <section class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('What we stand for') }}</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Built around a better experience') }}</h2>
                <p class="mt-4 text-lg text-slate-600 dark:text-slate-400">{{ __('Every part of the journey is designed to be simple, reliable, and genuinely enjoyable.') }}</p>
            </div>

            @php
                $values = [
                    ['title' => __('Fast delivery'), 'desc' => __('Orders ship within 24 hours and arrive in 3–5 business days, straight to your door.'), 'icon' => 'M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12', 'bg' => 'bg-sky-50 text-sky-600 dark:bg-sky-500/15 dark:text-sky-400'],
                    ['title' => __('Premium quality'), 'desc' => __('Carefully sourced materials and rigorous checks so every piece is made to last.'), 'icon' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z', 'bg' => 'bg-amber-50 text-amber-600 dark:bg-amber-500/15 dark:text-amber-400'],
                    ['title' => __('Secure payments'), 'desc' => __('Checkout with confidence using encrypted, industry-standard payment processing.'), 'icon' => 'M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z', 'bg' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400'],
                    ['title' => __('Real support'), 'desc' => __('A friendly, human team ready to help with sizing, orders, or anything else.'), 'icon' => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155', 'bg' => 'bg-violet-50 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400'],
                ];
            @endphp

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($values as $value)
                    <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-transparent hover:shadow-xl dark:border-slate-800 dark:bg-slate-900 dark:hover:shadow-black/40">
                        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-indigo-500 to-violet-500 opacity-0 transition group-hover:opacity-100"></div>
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl {{ $value['bg'] }}">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $value['icon'] }}" />
                            </svg>
                        </span>
                        <h3 class="mt-5 text-lg font-bold text-slate-900 dark:text-white">{{ $value['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Process -->
    <section class="border-t border-slate-100 bg-slate-50/80 py-16 dark:border-slate-800 dark:bg-slate-900/80 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('How it works') }}</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('From cart to doorstep in three steps') }}</h2>
            </div>

            @php
                $steps = [
                    ['title' => __('Pick your favorites'), 'desc' => __('Browse the collection and add what you love to your cart.')],
                    ['title' => __('Checkout securely'), 'desc' => __('Pay safely with encrypted, industry-standard processing.')],
                    ['title' => __('We handle the rest'), 'desc' => __('We pack with care and ship within 24 hours, with tracking included.')],
                ];
            @endphp

            <div class="mt-14 grid gap-6 md:grid-cols-3">
                @foreach ($steps as $index => $step)
                    <div class="relative rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-950">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 text-lg font-extrabold text-white shadow-lg shadow-indigo-600/25">{{ $index + 1 }}</span>
                        <h3 class="mt-5 text-lg font-bold text-slate-900 dark:text-white">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('Loved by customers') }}</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Don’t just take our word for it') }}</h2>
            </div>

            @php
                $testimonials = [
                    ['quote' => __('The quality is even better than I expected, and it arrived two days early. I will definitely order again.'), 'name' => 'Sarah M.', 'role' => __('Verified buyer')],
                    ['quote' => __('Beautiful packaging, fast shipping, and the support team answered my question within an hour.'), 'name' => 'Omar K.', 'role' => __('Verified buyer')],
                    ['quote' => __('Finally a store that makes returns easy. I exchanged sizes without any hassle at all.'), 'name' => 'Lina R.', 'role' => __('Verified buyer')],
                ];
            @endphp

            <div class="mt-14 grid gap-6 md:grid-cols-3">
                @foreach ($testimonials as $testimonial)
                    <figure class="flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-center gap-1 text-amber-400">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                </svg>
                            @endfor
                        </div>
                        <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-slate-600 dark:text-slate-400">“{{ $testimonial['quote'] }}”</blockquote>
                        <figcaption class="mt-5 flex items-center gap-3 border-t border-slate-100 pt-5 dark:border-slate-800">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 text-sm font-bold text-white">{{ \Illuminate\Support\Str::substr($testimonial['name'], 0, 1) }}</span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $testimonial['name'] }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $testimonial['role'] }}</p>
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="pb-16 sm:pb-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 px-6 py-16 text-center shadow-2xl shadow-indigo-600/25 sm:px-16">
                <div class="pointer-events-none absolute -left-16 -top-16 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -right-10 h-72 w-72 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">{{ __('Ready to find your new favorite?') }}</h2>
                    <p class="mx-auto mt-4 max-w-xl text-lg text-indigo-100">{{ __('Explore the full collection and experience shopping the way it should be.') }}</p>
                    <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3.5 text-base font-semibold text-indigo-700 shadow-lg transition hover:-translate-y-0.5 hover:bg-indigo-50">
                            {{ __('Browse products') }}
                        </a>
                        <a href="{{ route('pages.contact') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/30 bg-white/10 px-6 py-3.5 text-base font-semibold text-white backdrop-blur transition hover:bg-white/20">
                            {{ __('Contact us') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-storefront-layout>
