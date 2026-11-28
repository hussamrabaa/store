<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.orders.index') }}"
                   aria-label="{{ __('Back to orders') }}"
                   class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200">
                    <svg class="h-5 w-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <div class="flex flex-wrap items-center gap-3">
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $order->number }}</h2>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $order->statusColor() }}">
                            {{ __($order->statusLabel()) }}
                        </span>
                    </div>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Order placed') }} {{ $order->created_at->format('M j, Y \a\t g:i A') }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                    <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Order items') }}</h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                                <thead class="bg-slate-50 dark:bg-slate-800/50">
                                    <tr>
                                        <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Product') }}</th>
                                        <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Price') }}</th>
                                        <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Qty') }}</th>
                                        <th class="px-6 py-3.5 text-end text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Line total') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    @if ($item->product?->image)
                                                        <img src="{{ asset($item->product->image) }}" alt="{{ $item->name }}"
                                                             class="h-12 w-12 rounded-xl bg-white object-contain p-1 ring-1 ring-slate-200 dark:bg-slate-950 dark:ring-slate-700">
                                                    @else
                                                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">
                                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" />
                                                            </svg>
                                                        </span>
                                                    @endif
                                                    <div>
                                                        <p class="font-semibold text-slate-900 dark:text-white">{{ $item->name }}</p>
                                                        @if ($item->product)
                                                            <a href="{{ route('products.show', $item->product) }}" target="_blank" rel="noopener"
                                                               class="text-xs font-medium text-indigo-600 transition hover:text-indigo-500 dark:text-indigo-400">{{ __('View product') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-slate-700 dark:text-slate-300">${{ number_format((float) $item->price, 2) }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-slate-700 dark:text-slate-300">{{ $item->quantity }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-end font-semibold text-slate-900 dark:text-white">${{ number_format($item->lineTotal(), 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="border-t border-slate-100 px-6 py-5 dark:border-slate-800">
                            <dl class="ms-auto max-w-xs space-y-2 text-sm">
                                <div class="flex items-center justify-between">
                                    <dt class="text-slate-500 dark:text-slate-400">{{ __('Subtotal') }}</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white">${{ number_format((float) $order->subtotal, 2) }}</dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-slate-500 dark:text-slate-400">{{ __('Shipping') }}</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white">
                                        {{ (float) $order->shipping === 0.0 ? __('Free') : '$'.number_format((float) $order->shipping, 2) }}
                                    </dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-slate-100 pt-2 dark:border-slate-800">
                                    <dt class="text-base font-bold text-slate-900 dark:text-white">{{ __('Total') }}</dt>
                                    <dd class="text-lg font-extrabold text-slate-900 dark:text-white">${{ number_format((float) $order->total, 2) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Update status') }}</h3>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Change the status of this order.') }}</p>

                        <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="mt-4 space-y-3">
                            @csrf
                            @method('PATCH')

                            <label for="order-status" class="sr-only">{{ __('Status') }}</label>
                            <select id="order-status" name="status"
                                    class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}" @selected($order->status === $value)>{{ __($label) }}</option>
                                @endforeach
                            </select>

                            <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:shadow-indigo-600/40 hover:brightness-110">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                {{ __('Update status') }}
                            </button>
                        </form>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Customer information') }}</h3>

                        <dl class="mt-4 space-y-3 text-sm">
                            <div>
                                <dt class="text-slate-500 dark:text-slate-400">{{ __('Name') }}</dt>
                                <dd class="font-semibold text-slate-900 dark:text-white">{{ $order->customer_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 dark:text-slate-400">{{ __('Email') }}</dt>
                                <dd class="font-semibold text-slate-900 dark:text-white">
                                    <a href="mailto:{{ $order->email }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ $order->email }}</a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 dark:text-slate-400">{{ __('Phone') }}</dt>
                                <dd class="font-semibold text-slate-900 dark:text-white">
                                    <a href="tel:{{ $order->phone }}" class="transition hover:text-indigo-600 dark:hover:text-indigo-400">{{ $order->phone }}</a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 dark:text-slate-400">{{ __('Account') }}</dt>
                                <dd class="font-semibold text-slate-900 dark:text-white">
                                    {{ $order->user ? __('Registered customer') : __('Guest') }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Shipping address') }}</h3>

                        <address class="mt-4 space-y-1 text-sm not-italic text-slate-700 dark:text-slate-300">
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $order->customer_name }}</p>
                            <p>{{ $order->address }}</p>
                            <p>{{ $order->city }}, {{ $order->postal_code }}</p>
                            <p>{{ $order->country }}</p>
                        </address>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Payment method') }}</h3>

                        <p class="mt-4 inline-flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                            {{ __($order->paymentMethodLabel()) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
