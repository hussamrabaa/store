<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 border border-transparent rounded-xl font-semibold text-sm text-white shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:brightness-95 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
