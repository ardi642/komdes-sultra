@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-zinc-100 border-zinc-300 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-3 px-4 text-zinc-900 disabled:bg-zinc-200 disabled:text-zinc-500 transition-colors']) !!}>
