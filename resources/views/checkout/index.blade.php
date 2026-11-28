<x-storefront-layout :title="__('Payment')">
    <div x-data="{
        method: 'card',
        processing: false,
        success: false,
        orderId: '',
        error: '',
        async submit(event, items) {
            if (this.processing) {
                return;
            }

            this.processing = true;
            this.error = '';

            const form = event.target;
            const formData = new FormData(form);
            formData.append('items', JSON.stringify(items));

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const payload = await response.json().catch(() => ({}));

                if (!response.ok) {
                    this.error = payload.message || @js(__('Something went wrong. Please try again.'));
                    return;
                }

                this.orderId = payload.number;
                window.Alpine.store('cart').clear();
                this.success = true;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } catch (error) {
                this.error = @js(__('Something went wrong. Please try again.'));
            } finally {
                this.processing = false;
            }
        },
    }">
        <!-- Hero -->
        <section class="mesh border-b border-slate-100 dark:border-slate-800">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
                <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Home') }}</a>
                    <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <a href="{{ route('cart.index') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Cart') }}</a>
                    <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <span class="font-medium text-slate-700 dark:text-slate-200">{{ __('Payment') }}</span>
                </nav>

                <div class="mt-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('Checkout') }}</span>
                        <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl">{{ __('Payment') }}</h1>
                        <p class="mt-3 text-lg text-slate-600 dark:text-slate-400">{{ __('Complete your order with a secure payment.') }}</p>
                    </div>

                    <div class="flex items-center gap-2 text-xs font-semibold">
                        <span class="flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            {{ __('Cart') }}
                        </span>
                        <span class="h-px w-4 bg-slate-300 dark:bg-slate-700"></span>
                        <span class="flex items-center gap-1.5 rounded-full bg-indigo-600 px-3 py-1.5 text-white">
                            <span class="flex h-4 w-4 items-center justify-center rounded-full bg-white/20 text-[10px]">2</span>
                            {{ __('Payment') }}
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Success -->
                <div x-show="success" x-cloak class="mx-auto max-w-xl rounded-3xl border border-emerald-200 bg-white p-8 text-center shadow-xl shadow-emerald-600/10 dark:border-emerald-500/30 dark:bg-slate-900 dark:shadow-black/40 sm:p-12">
                    <span class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400">
                        <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </span>
                    <h2 class="mt-6 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Payment successful!') }}</h2>
                    <p class="mt-3 text-slate-600 dark:text-slate-400">{{ __('Thank you for your order. A confirmation has been sent to your email.') }}</p>
                    <div class="mt-6 inline-flex items-center gap-2 rounded-xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        {{ __('Order number') }}:
                        <span class="font-extrabold text-indigo-600 dark:text-indigo-400" x-text="orderId"></span>
                    </div>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:-translate-y-0.5">
                            {{ __('Continue shopping') }}
                        </a>
                        <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-base font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                            {{ __('Back to home') }}
                        </a>
                    </div>
                </div>

                <!-- Empty cart -->
                <div x-show="!success && $store.cart.items.length === 0" x-cloak class="flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center dark:border-slate-700 dark:bg-slate-950">
                    <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </span>
                    <h2 class="mt-5 text-xl font-bold text-slate-900 dark:text-white">{{ __('Nothing to pay for yet') }}</h2>
                    <p class="mt-2 max-w-sm text-slate-600 dark:text-slate-400">{{ __('Your cart is empty. Add some products before proceeding to payment.') }}</p>
                    <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-indigo-600/25 transition hover:-translate-y-0.5">
                        {{ __('Browse products') }}
                    </a>
                </div>

                <!-- Checkout -->
                <form x-show="!success && $store.cart.items.length > 0" x-cloak method="POST" action="{{ route('checkout.store') }}"
                      @submit.prevent="submit($event, $store.cart.items)"
                      class="grid gap-8 lg:grid-cols-5 lg:gap-10">
                    @csrf
                    <div class="space-y-6 lg:col-span-3">
                        <!-- Contact -->
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                            <h2 class="flex items-center gap-2 text-lg font-bold text-slate-900 dark:text-white">
                                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-indigo-50 text-xs font-extrabold text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">1</span>
                                {{ __('Contact information') }}
                            </h2>
                            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Email') }}</label>
                                    <input id="email" name="email" type="email" required value="{{ auth()->user()?->email }}"
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200"
                                           placeholder="you@example.com">
                                </div>
                                <div>
                                    <label for="phone" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Phone') }}</label>
                                    <input id="phone" name="phone" type="tel" required
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200"
                                           placeholder="+1 (555) 123-4567">
                                </div>
                            </div>
                        </div>

                        <!-- Shipping -->
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                            <h2 class="flex items-center gap-2 text-lg font-bold text-slate-900 dark:text-white">
                                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-indigo-50 text-xs font-extrabold text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">2</span>
                                {{ __('Shipping address') }}
                            </h2>
                            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="full_name" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Full name') }}</label>
                                    <input id="full_name" name="full_name" type="text" required value="{{ auth()->user()?->name }}"
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="address" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Street address') }}</label>
                                    <input id="address" name="address" type="text" required
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                </div>
                                <div>
                                    <label for="city" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('City') }}</label>
                                    <input id="city" name="city" type="text" required
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                </div>
                                <div>
                                    <label for="postal_code" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Postal code') }}</label>
                                    <input id="postal_code" name="postal_code" type="text" required
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="country" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Country') }}</label>
                                    <input id="country" name="country" type="text" required
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                </div>
                            </div>
                        </div>

                        <!-- Payment -->
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                            <h2 class="flex items-center gap-2 text-lg font-bold text-slate-900 dark:text-white">
                                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-indigo-50 text-xs font-extrabold text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">3</span>
                                {{ __('Payment method') }}
                            </h2>

                            <div class="mt-5 grid gap-3 sm:grid-cols-3">
                                <label :class="method === 'card' ? 'border-indigo-600 bg-indigo-50/70 ring-1 ring-indigo-600 dark:bg-indigo-500/10' : 'border-slate-200 hover:border-slate-300 dark:border-slate-700'" class="flex cursor-pointer items-center gap-2 rounded-xl border p-3 text-sm font-semibold text-slate-700 transition dark:text-slate-200">
                                    <input type="radio" name="method" value="card" x-model="method" class="text-indigo-600 focus:ring-indigo-500">
                                    <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                    </svg>
                                    {{ __('Card') }}
                                </label>
                                <label :class="method === 'paypal' ? 'border-indigo-600 bg-indigo-50/70 ring-1 ring-indigo-600 dark:bg-indigo-500/10' : 'border-slate-200 hover:border-slate-300 dark:border-slate-700'" class="flex cursor-pointer items-center gap-2 rounded-xl border p-3 text-sm font-semibold text-slate-700 transition dark:text-slate-200">
                                    <input type="radio" name="method" value="paypal" x-model="method" class="text-indigo-600 focus:ring-indigo-500">
                                    <svg class="h-5 w-5 text-sky-600 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ __('PayPal') }}
                                </label>
                                <label :class="method === 'cod' ? 'border-indigo-600 bg-indigo-50/70 ring-1 ring-indigo-600 dark:bg-indigo-500/10' : 'border-slate-200 hover:border-slate-300 dark:border-slate-700'" class="flex cursor-pointer items-center gap-2 rounded-xl border p-3 text-sm font-semibold text-slate-700 transition dark:text-slate-200">
                                    <input type="radio" name="method" value="cod" x-model="method" class="text-indigo-600 focus:ring-indigo-500">
                                    <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                    </svg>
                                    {{ __('Cash on delivery') }}
                                </label>
                            </div>

                            <div x-show="method === 'card'" x-cloak class="mt-5 space-y-4">
                                <div>
                                    <label for="card_name" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Name on card') }}</label>
                                    <input id="card_name" name="card_name" type="text" :required="method === 'card'"
                                           class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200"
                                           placeholder="{{ __('Jane Doe') }}">
                                </div>
                                <div>
                                    <label for="card_number" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Card number') }}</label>
                                    <div class="relative">
                                        <input id="card_number" name="card_number" type="text" inputmode="numeric" :required="method === 'card'" maxlength="19"
                                               class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 pe-12 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200"
                                               placeholder="1234 5678 9012 3456">
                                        <span class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-4 text-slate-400">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label for="card_expiry" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Expiry date') }}</label>
                                        <input id="card_expiry" name="card_expiry" type="text" :required="method === 'card'" placeholder="MM / YY"
                                               class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                    </div>
                                    <div>
                                        <label for="card_cvc" class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('CVC') }}</label>
                                        <input id="card_cvc" name="card_cvc" type="text" inputmode="numeric" :required="method === 'card'" maxlength="4" placeholder="123"
                                               class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                    </div>
                                </div>
                            </div>

                            <div x-show="method === 'paypal'" x-cloak class="mt-5 rounded-xl border border-sky-200 bg-sky-50 p-4 text-sm text-sky-800 dark:border-sky-500/30 dark:bg-sky-500/10 dark:text-sky-300">
                                {{ __('You will be redirected to PayPal to complete your payment securely.') }}
                            </div>

                            <div x-show="method === 'cod'" x-cloak class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                                {{ __('Pay in cash when your order is delivered. Please have the exact amount ready.') }}
                            </div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="lg:col-span-2">
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 lg:sticky lg:top-24">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Order summary') }}</h2>

                            <ul class="mt-5 space-y-4">
                                <template x-for="item in $store.cart.items" :key="item.id">
                                    <li class="flex items-center gap-3">
                                        <div class="relative flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                            <template x-if="item.image">
                                                <img :src="item.image" :alt="item.name" class="h-full w-full object-contain p-1.5">
                                            </template>
                                            <template x-if="!item.image">
                                                <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" />
                                                </svg>
                                            </template>
                                            <span class="absolute -end-1.5 -top-1.5 inline-flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-slate-700 px-1 text-[11px] font-bold text-white dark:bg-slate-600" x-text="item.qty"></span>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="truncate text-sm font-semibold text-slate-900 dark:text-white" x-text="item.name"></p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400" x-text="$store.cart.money(item.price) + ' × ' + item.qty"></p>
                                        </div>
                                        <p class="text-sm font-bold text-slate-900 dark:text-white" x-text="$store.cart.money(item.price * item.qty)"></p>
                                    </li>
                                </template>
                            </ul>

                            <dl class="mt-6 space-y-3 border-t border-slate-100 pt-5 text-sm dark:border-slate-800">
                                <div class="flex items-center justify-between">
                                    <dt class="text-slate-600 dark:text-slate-400">{{ __('Subtotal') }}</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white" x-text="$store.cart.money($store.cart.subtotal)"></dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-slate-600 dark:text-slate-400">{{ __('Shipping') }}</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white" x-text="$store.cart.shipping === 0 ? @js(__('Free')) : $store.cart.money($store.cart.shipping)"></dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-slate-100 pt-3 dark:border-slate-800">
                                    <dt class="text-base font-bold text-slate-900 dark:text-white">{{ __('Total') }}</dt>
                                    <dd class="text-xl font-extrabold text-slate-900 dark:text-white" x-text="$store.cart.money($store.cart.total)"></dd>
                                </div>
                            </dl>

                            <div x-show="error" x-cloak class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300" x-text="error"></div>

                            <button type="submit" :disabled="processing"
                                    class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-indigo-600/25 transition hover:-translate-y-0.5 hover:shadow-indigo-600/40 disabled:cursor-not-allowed disabled:opacity-70 disabled:hover:translate-y-0">
                                <svg x-show="processing" x-cloak class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                <svg x-show="!processing" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                <span x-text="processing ? @js(__('Processing...')) : @js(__('Pay now'))"></span>
                            </button>

                            <div class="mt-4 flex items-center justify-center gap-4 text-xs font-medium text-slate-400 dark:text-slate-500">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ __('Secure') }}
                                </span>
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                    {{ __('Encrypted') }}
                                </span>
                                <a href="{{ route('cart.index') }}" class="text-indigo-600 transition hover:text-indigo-500 dark:text-indigo-400">{{ __('Edit cart') }}</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-storefront-layout>
