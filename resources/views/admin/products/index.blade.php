<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700">
                {{ __('Add product') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="rounded-md bg-green-100 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-md bg-red-100 text-red-800 px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Image') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Price') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Created by') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-6 py-4">
                                    @if ($product->image)
                                        <img src="{{ \Storage::url($product->image) }}" alt="{{ $product->name }}"
                                             class="h-12 w-12 object-cover rounded">
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-800">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-gray-800">${{ number_format((float) $product->price, 2) }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $product->user?->name }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="text-sm text-indigo-600 hover:underline">{{ __('Edit') }}</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                              onsubmit="return confirm('Delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:underline">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                    {{ __('No products yet. Create your first product.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
