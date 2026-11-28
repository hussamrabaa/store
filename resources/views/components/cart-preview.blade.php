<div x-data="{ open: false }" @keydown.escape.window="open = false" @click.outside="open = false" class="relative">
    <button type="button" @click="open = ! open" :aria-expanded="open" aria-haspopup="true"
            aria-label="{{ __('Cart') }}"
            class="relative inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:bg-slate-50 hover:text-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </svg>
        <span x-show="$store.cart.count > 0" x-cloak x-text="$store.cart.count" class="absolute -end-1.5 -top-1.5 inline-flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-gradient-to-br from-indigo-600 to-violet-600 px-1 text-[11px] font-bold text-white shadow"></span>
    </button>

    <div x-show="open" x-cloak x-transition
         class="fixed inset-x-4 top-24 z-50 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/10 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/50 md:absolute md:inset-x-auto md:end-0 md:top-auto md:mt-2 md:w-96">
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3 dark:border-slate-800">
            <p class="text-sm font-bold text-slate-900 dark:text-white">
                {{ __('Your cart') }}
                <span x-show="$store.cart.count > 0" x-cloak x-text="'(' + $store.cart.count + ')'" class="text-slate-400 dark:text-slate-500"></span>
            </p>
            <button type="button" x-show="$store.cart.items.length > 0" x-cloak @click="$store.cart.clear()"
                    class="text-xs font-semibold text-rose-600 transition hover:text-rose-500 dark:text-rose-400">
                {{ __('Clear') }}
            </button>
        </div>

        <!-- Empty -->
        <div x-show="$store.cart.items.length === 0" class="flex flex-col items-center px-4 py-10 text-center">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-400">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
            </span>
            <p class="mt-3 text-sm font-semibold text-slate-900 dark:text-white">{{ __('Your cart is empty') }}</p>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ __('Add something you love to get started.') }}</p>
            <a href="{{ route('products.index') }}" @click="open = false"
               class="mt-4 inline-flex items-center justify-center gap-1.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:brightness-110">
                {{ __('Browse products') }}
            </a>
        </div>

        <!-- Items -->
        <div x-show="$store.cart.items.length > 0" x-cloak>
            <ul class="max-h-80 divide-y divide-slate-100 overflow-y-auto dark:divide-slate-800">
                <template x-for="item in $store.cart.items" :key="item.id">
                    <li class="flex items-center gap-3 p-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                            <template x-if="item.image">
                                <img :src="item.image" :alt="item.name" class="h-full w-full object-contain p-1.5">
                            </template>
                            <template x-if="!item.image">
                                <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" />
                                </svg>
                            </template>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-slate-900 dark:text-white" x-text="item.name"></p>
                            <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                <span x-text="$store.cart.money(item.price)"></span>
                                <span class="mx-1">×</span>
                                <span x-text="item.qty"></span>
                            </p>
                        </div>
                        <button type="button" @click="$store.cart.remove(item.id)"
                                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-500/10 dark:hover:text-rose-400"
                                :aria-label="@js(__('Remove item'))">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </li>
                </template>
            </ul>

            <div class="border-t border-slate-100 p-4 dark:border-slate-800">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-600 dark:text-slate-400">{{ __('Subtotal') }}</span>
                    <span class="font-extrabold text-slate-900 dark:text-white" x-text="$store.cart.money($store.cart.subtotal)"></span>
                </div>
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ __('Shipping calculated at checkout') }}</p>

                <div class="mt-3 grid grid-cols-2 gap-2">
                    <a href="{{ route('cart.index') }}" @click="open = false"
                       class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:bg-slate-800">
                        {{ __('View cart') }}
                    </a>
                    <a href="{{ route('checkout.index') }}" @click="open = false"
                       class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-3 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:brightness-110">
                        {{ __('Checkout') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
