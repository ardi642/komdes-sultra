@props(['options' => [], 'multiple' => false, 'placeholder' => 'Pilih...'])

<div wire:ignore x-data="{
        value: @entangle($attributes->wire('model')),
        tomSelectInstance: null,
        init() {
            this.tomSelectInstance = new window.TomSelect(this.$refs.select, {
                plugins: {
                    remove_button: {
                        title: 'Hapus ini',
                    }
                },
                placeholder: '{{ $placeholder }}',
                maxOptions: 50,
                hideSelected: true,
                dropdownParent: 'body',
            });
            
            this.tomSelectInstance.on('change', (val) => {
                this.value = val;
            });
            
            this.$watch('value', (val) => {
                if (this.tomSelectInstance) {
                    // Update TomSelect if Livewire changes the value externally
                    this.tomSelectInstance.setValue(val, true); // true = silent to prevent loop
                }
            });
            
            // Set initial value
            if (this.value) {
                this.tomSelectInstance.setValue(this.value, true);
            }
        }
    }">
    <select x-ref="select" {{ $attributes->whereDoesntStartWith('wire:model') }} @if($multiple) multiple @endif>
        @if(!$multiple && $placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>
</div>
