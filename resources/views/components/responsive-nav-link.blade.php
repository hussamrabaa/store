@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-lg bg-indigo-50 px-3 py-2.5 text-start text-base font-semibold text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full rounded-lg px-3 py-2.5 text-start text-base font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
