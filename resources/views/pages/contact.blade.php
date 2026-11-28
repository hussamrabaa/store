<x-storefront-layout :title="__('Contact')">
    <!-- Hero -->
    <section class="mesh border-b border-slate-100 dark:border-slate-800">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Home') }}</a>
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="font-medium text-slate-700 dark:text-slate-200">{{ __('Contact') }}</span>
            </nav>

            <div class="mt-6 max-w-2xl animate-fade-up">
                <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('Get in touch') }}</span>
                <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl">{{ __("Have a question? Let's talk.") }}</h1>
                <p class="mt-4 text-lg text-slate-600 dark:text-slate-400">{{ __('Our team is here to help with sizing, orders, or anything else. We usually reply within one business day.') }}</p>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-5 lg:gap-16">
                <!-- Contact details -->
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Contact details') }}</h2>
                    <p class="mt-3 text-slate-600 dark:text-slate-400">{{ __('Prefer to reach us directly? Use any of the channels below.') }}</p>

                    <div class="mt-8 space-y-4">
                        <a href="mailto:hello@example.com" class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md dark:border-slate-800 dark:bg-slate-900 dark:hover:border-indigo-500/40">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('Email us') }}</p>
                                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">hello@example.com</p>
                            </div>
                        </a>

                        <a href="tel:+15551234567" class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md dark:border-slate-800 dark:bg-slate-900 dark:hover:border-indigo-500/40">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('Call us') }}</p>
                                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">+1 (555) 123-4567</p>
                            </div>
                        </a>

                        <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('Visit us') }}</p>
                                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">123 Market Street, Suite 400<br>San Francisco, CA 94103</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400">
                        <p class="font-semibold text-slate-900 dark:text-white">{{ __('Support hours') }}</p>
                        <p class="mt-1">{{ __('Monday – Friday: 9:00 – 18:00') }}</p>
                        <p>{{ __('Saturday: 10:00 – 14:00') }}</p>
                    </div>
                </div>

                <!-- Form -->
                <div class="lg:col-span-3">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/40 sm:p-8">
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Send us a message') }}</h2>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">{{ __('Fill out the form and we will get back to you as soon as possible.') }}</p>

                        @if (session('status'))
                            <div class="mt-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('status') }}</span>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('pages.contact.submit') }}" class="mt-6 space-y-5">
                            @csrf

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Name') }}</label>
                                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                    @error('name')
                                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Email') }}</label>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                    @error('email')
                                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Subject') }}</label>
                                <input id="subject" name="subject" type="text" value="{{ old('subject') }}"
                                       class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200"
                                       placeholder="{{ __('How can we help?') }}">
                                @error('subject')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="message" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Message') }}</label>
                                <textarea id="message" name="message" rows="6" required
                                          class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200"
                                          placeholder="{{ __('Tell us a little more...') }}">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-indigo-600/25 transition hover:-translate-y-0.5 hover:shadow-indigo-600/40 sm:w-auto">
                                {{ __('Send message') }}
                                <svg class="h-5 w-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- FAQ -->
            <div class="mx-auto mt-16 max-w-3xl" x-data="{ open: null }">
                <div class="text-center">
                    <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('FAQ') }}</span>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Frequently asked questions') }}</h2>
                </div>

                @php
                    $faqs = [
                        ['q' => __('How long does shipping take?'), 'a' => __('Orders are processed within 24 hours and typically arrive within 3–5 business days. Shipping is free on orders over $50.')],
                        ['q' => __('What is your return policy?'), 'a' => __('Return any unused item within 30 days for a full refund — no questions asked.')],
                        ['q' => __('How do I choose the right size?'), 'a' => __('Each product page includes a sizing guide. If you are between sizes, our support team is happy to help.')],
                        ['q' => __('Which payment methods do you accept?'), 'a' => __('We accept all major credit and debit cards, as well as popular digital wallets.')],
                    ];
                @endphp

                <div class="mt-10 space-y-3">
                    @foreach ($faqs as $index => $faq)
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                            <button type="button" @click="open = open === {{ $index }} ? null : {{ $index }}"
                                    class="flex w-full items-center justify-between gap-4 px-5 py-4 text-start text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $faq['q'] }}
                                <svg :class="open === {{ $index }} ? 'rotate-180' : ''" class="h-5 w-5 shrink-0 text-slate-400 transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <div x-show="open === {{ $index }}" x-cloak x-transition class="px-5 pb-5 text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-storefront-layout>
