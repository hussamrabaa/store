<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Create product') }}</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Add a new item to your catalog.') }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">
                @include('admin.products._form', [
                    'action' => route('admin.products.store'),
                    'method' => 'POST',
                    'submit' => __('Create product'),
                ])
            </div>
        </div>
    </div>
</x-app-layout>
