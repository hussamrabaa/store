<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if (($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                      :value="old('name', $product->name ?? '')" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" :value="__('Description')" />
        <textarea id="description" name="description" rows="4" required
                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $product->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="price" :value="__('Price')" />
        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full"
                      :value="old('price', $product->price ?? '')" required />
        <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="image" :value="__('Image')" />
        @isset($product)
            @if ($product->image)
                <img src="{{ \Storage::url($product->image) }}" alt="{{ $product->name }}"
                     class="h-20 w-20 object-cover rounded mt-2">
            @endif
        @endisset
        <input id="image" name="image" type="file" accept="image/*"
               class="mt-2 block w-full text-sm text-gray-700" @if (! isset($product)) required @endif>
        <p class="text-xs text-gray-500 mt-1">{{ __('JPG, PNG or WEBP. Max 2 MB.') }}</p>
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submit }}</x-primary-button>
        <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:underline">
            {{ __('Cancel') }}
        </a>
    </div>
</form>
