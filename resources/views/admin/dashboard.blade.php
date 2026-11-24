<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">{{ __('Products') }}</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['products'] }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">{{ __('Users') }}</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['users'] }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">{{ __('Admins') }}</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['admins'] }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ __('Recent products') }}</h3>
                        @if (in_array(Auth::user()->role, ['admin', 'editor'], true))
                            <a href="{{ route('admin.products.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700">
                                {{ __('Add product') }}
                            </a>
                        @endif
                    </div>

                    @if ($recentProducts->isEmpty())
                        <p class="text-gray-500">{{ __('No products yet.') }}</p>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach ($recentProducts as $product)
                                <li class="py-3 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        @if ($product->image)
                                            <img src="{{ \Storage::url($product->image) }}" alt="{{ $product->name }}"
                                                 class="h-12 w-12 object-cover rounded">
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $product->name }}</p>
                                            <p class="text-sm text-gray-500">${{ number_format((float) $product->price, 2) }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="text-sm text-indigo-600 hover:underline">{{ __('Edit') }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
