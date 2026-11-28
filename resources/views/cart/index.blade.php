<x-storefront-layout :title="__('Cart')">
    <!-- Hero -->
    <section class="mesh border-b border-slate-100 dark:border-slate-800">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ __('Home') }}</a>
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="font-medium text-slate-700 dark:text-slate-200">{{ __('Cart') }}</span>
            </nav>

            <div class="mt-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <span class="text-sm font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ __('Your bag') }}</span>
                    <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl">{{ __('Shopping cart') }}</h1>
                    <p class="mt-3 text-lg text-slate-600 dark:text-slate-400">{{ __('Review your items before heading to checkout.') }}</p>
                </div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                    <svg class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    {{ __('Continue shopping') }}
                </a>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Empty state -->
            <div x-show="$store.cart.items.length === 0" x-cloak class="flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center dark:border-slate-700 dark:bg-slate-950">
                <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </span>
                <h2 class="mt-5 text-xl font-bold text-slate-900 dark:text-white">{{ __('Your cart is empty') }}</h2>
                <p class="mt-2 max-w-sm text-slate-600 dark:text-slate-400">{{ __('Looks like you have not added anything yet. Explore the collection and find something you love.') }}</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-indigo-600/25 transition hover:-translate-y-0.5 hover:shadow-indigo-600/40">
                    {{ __('Browse products') }}
                    <svg class="h-5 w-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <!-- Cart content -->
            <div x-show="$store.cart.items.length > 0" x-cloak class="grid gap-8 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 dark:border-slate-800">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Items') }}</h2>
                            <button type="button" @click="$store.cart.clear()" class="text-sm font-semibold text-rose-600 transition hover:text-rose-500 dark:text-rose-400">{{ __('Clear cart') }}</button>
                        </div>

                        <ul class="divide-y divide-slate-100 dark:divide-slate-800">
                            <template x-for="item in $store.cart.items" :key="item.id">
                                <li class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center">
                                    <div class="flex flex-1 items-center gap-4">
                                        <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                            <template x-if="item.image">
                                                <img :src="item.image" :alt="item.name" class="h-full w-full object-contain p-2">
                                            </template>
                                            <template x-if="!item.image">
                                                <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" />
                                                </svg>
                                            </template>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-bold text-slate-900 dark:text-white" x-text="item.name"></p>
                                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400" x-text="$store.cart.money(item.price)"></p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between gap-4 sm:justify-end">
                                        <div class="inline-flex items-center rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-950">
                                            <button type="button" @click="$store.cart.update(item.id, item.qty - 1)"
                                                    class="flex h-9 w-9 items-center justify-center rounded-s-xl text-slate-500 transition hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                                                    :aria-label="@js(__('Decrease quantity'))">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" /></svg>
                                            </button>
                                            <input type="text" :value="item.qty" readonly class="h-9 w-10 border-0 bg-transparent p-0 text-center text-sm font-bold text-slate-900 focus:ring-0 dark:text-white" :aria-label="@js(__('Quantity'))">
                                            <button type="button" @click="$store.cart.update(item.id, item.qty + 1)"
                                                    class="flex h-9 w-9 items-center justify-center rounded-e-xl text-slate-500 transition hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                                                    :aria-label="@js(__('Increase quantity'))">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                            </button>
                                        </div>

                                        <div class="w-20 text-end">
                                            <p class="text-sm font-extrabold text-slate-900 dark:text-white" x-text="$store.cart.money(item.price * item.qty)"></p>
                                        </div>

                                        <button type="button" @click="$store.cart.remove(item.id)"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-500/10 dark:hover:text-rose-400"
                                                :aria-label="@js(__('Remove item'))">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>

                    <div class="mt-4 flex items-center gap-2 rounded-xl border border-indigo-100 bg-indigo-50/70 px-4 py-3 text-sm text-indigo-700 dark:border-indigo-500/20 dark:bg-indigo-500/10 dark:text-indigo-300">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        <span x-text="$store.cart.shipping === 0 ? @js(__('You qualify for free shipping!')) : @js(__('Add :amount more for free shipping')).replace(':amount', $store.cart.money(50 - $store.cart.subtotal))"></span>
                    </div>
                </div>

                <!-- Summary -->
                <div class="lg:col-span-1">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 lg:sticky lg:top-24">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Order summary') }}</h2>

                        <dl class="mt-5 space-y-3 text-sm">
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

                        <a href="{{ route('checkout.index') }}" class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-indigo-600/25 transition hover:-translate-y-0.5 hover:shadow-indigo-600/40">
                            {{ __('Proceed to payment') }}
                            <svg class="h-5 w-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>

                        <p class="mt-4 flex items-center justify-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            {{ __('Secure, encrypted checkout') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-storefront-layout>
