@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2.5 px-3 text-zinc-900 disabled:bg-zinc-100 disabled:text-zinc-500']) !!}>
