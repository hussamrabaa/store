<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Orders') }}</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Track and manage customer orders.') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                    <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300">
                    <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-5">
                <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative flex-1">
                        <label for="order-search" class="sr-only">{{ __('Search orders') }}</label>
                        <span class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-slate-400 dark:text-slate-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </span>
                        <input id="order-search" type="search" name="search" value="{{ $search }}"
                               placeholder="{{ __('Search by order number, customer, or email') }}"
                               class="h-11 w-full rounded-xl border border-slate-200 bg-white ps-10 pe-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200">
                    </div>

                    <div>
                        <label for="order-status" class="sr-only">{{ __('Status') }}</label>
                        <select id="order-status" name="status"
                                class="h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 sm:w-48">
                            <option value="">{{ __('All statuses') }}</option>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected($status === $value)>{{ __($label) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                            class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:shadow-indigo-600/40 hover:brightness-110">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>
                        {{ __('Filter') }}
                    </button>

                    @if ($search !== '' || $status !== '')
                        <a href="{{ route('admin.orders.index') }}"
                           class="inline-flex h-11 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                            {{ __('Clear filters') }}
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Order') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Customer') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Date') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Items') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Total') }}</th>
                                <th class="px-6 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Status') }}</th>
                                <th class="px-6 py-3.5 text-end text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse ($orders as $order)
                                <tr class="transition hover:bg-slate-50/70 dark:hover:bg-slate-800/40">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="font-semibold text-slate-900 dark:text-white">{{ $order->number }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-slate-900 dark:text-white">{{ $order->customer_name }}</p>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $order->email }}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <p class="text-slate-700 dark:text-slate-300">{{ $order->created_at->format('M j, Y') }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $order->created_at->format('g:i A') }}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-slate-700 dark:text-slate-300">{{ $order->items_count }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-900 dark:text-white">${{ number_format((float) $order->total, 2) }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                    aria-label="{{ __('Update status') }}"
                                                    class="cursor-pointer rounded-full border-0 py-1.5 ps-3 pe-8 text-xs font-semibold ring-1 ring-inset transition focus:ring-2 focus:ring-indigo-500 {{ $order->statusColor() }}">
                                                @foreach ($statuses as $value => $label)
                                                    <option value="{{ $value }}" @selected($order->status === $value)>{{ __($label) }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="sr-only">{{ __('Update status') }}</button>
                                        </form>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center justify-end">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                               class="rounded-lg px-3 py-1.5 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-500/10">{{ __('View') }}</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">
                                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2.25 5.25H6.75A2.25 2.25 0 014.5 19V5.25A2.25 2.25 0 016.75 3h7.5l4.5 4.5v11.25A2.25 2.25 0 0116.5 21z" />
                                                </svg>
                                            </span>
                                            <p class="mt-4 font-semibold text-slate-900 dark:text-white">{{ __('No orders found') }}</p>
                                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Orders will appear here once customers check out.') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
