@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-zinc-700 mb-1']) }}>
    {{ $value ?? $slot }}
</label>
