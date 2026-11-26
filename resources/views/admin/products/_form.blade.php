<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-5">
    @csrf
    @if (($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1.5 block w-full"
                      :value="old('name', $product->name ?? '')" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" :value="__('Description')" />
        <textarea id="description" name="description" rows="4" required
                  class="mt-1.5 block w-full border-slate-300 bg-white text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500">{{ old('description', $product->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="price" :value="__('Price')" />
        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1.5 block w-full"
                      :value="old('price', $product->price ?? '')" required />
        <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="image" :value="__('Image')" />
        @isset($product)
            @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                     class="mt-2 h-20 w-20 rounded-xl bg-white object-contain p-1 ring-1 ring-slate-200 dark:bg-slate-950 dark:ring-slate-700">
            @endif
        @endisset
        <input id="image" name="image" type="file" accept="image/*"
               class="mt-2 block w-full text-sm text-slate-600 file:me-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 dark:text-slate-300 dark:file:bg-indigo-500/15 dark:file:text-indigo-300 dark:hover:file:bg-indigo-500/25" @if (! isset($product)) required @endif>
        <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">{{ __('JPG, PNG or WEBP. Max 2 MB.') }}</p>
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    </div>

    <div class="flex items-center gap-3 border-t border-slate-100 pt-5 dark:border-slate-800">
        <x-primary-button>{{ $submit }}</x-primary-button>
        <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-slate-500 transition hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200">
            {{ __('Cancel') }}
        </a>
    </div>
</form>
