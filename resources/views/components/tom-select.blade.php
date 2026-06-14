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
                // Convert to raw array/value to avoid Proxy issues
                let rawVal = JSON.parse(JSON.stringify(val));
                if (JSON.stringify(this.value) !== JSON.stringify(rawVal)) {
                    this.value = rawVal;
                }
            });
            
            this.$watch('value', (val) => {
                if (this.tomSelectInstance) {
                    let currentVal = this.tomSelectInstance.getValue();
                    let rawVal = JSON.parse(JSON.stringify(val));
                    if (JSON.stringify(currentVal) !== JSON.stringify(rawVal)) {
                        this.tomSelectInstance.setValue(rawVal, true);
                    }
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
