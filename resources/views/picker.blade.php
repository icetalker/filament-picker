@php
    use Filament\Support\Colors\Color;
    use Filament\Support\Enums\Alignment;

    $options = $getOptions();
    $icons = $getIcons();
    $images = $getImages();
    $imageOnly = $getImageOnly();
    $imageSize = $getImageSize() ?: 50;
    $checkedColor = Color::Green[500];
    $multiple = $getMultiple();
    $bgColor = $getBackgroundColor();
    $activeBgColor = $getActiveBackgroundColor();
    $alignment = $getAlignment();

    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :field="$field"
>
    <div
        {{ $attributes->merge($getExtraAttributes())->class(['it-picker']) }}
    >
        <div
            @if($multiple)
                x-data="{
                    state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
                    init() {
                        if (!Array.isArray(this.state)) {
                            this.state = this.state ? [this.state] : [];
                        }
                    },
                    setState: function(value) {
                        if (this.state.includes(value)) {
                            this.state = this.state.filter(item => item !== value);
                        } else {
                            this.state.push(value);
                        }
                    }
                    }"
            @else
                x-data="{
                    state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
                        setState: function(value) {
                            if(this.state == value){
                                this.state = ''
                                return
                            }
                            this.state = value;

                            {{-- this.$refs.input.value = value --}}
                        }
                    }"
            @endif
            @class([
                'flex flex-wrap gap-2',
                match ($alignment) {
                    Alignment::Start => 'justify-start',
                    Alignment::Center => 'justify-center',
                    Alignment::End => 'justify-end',
                    Alignment::Left => 'justify-start',
                    Alignment::Right => 'justify-end',
                    Alignment::Between => 'justify-between',
                    Alignment::Justify => 'justify-around',
                    default => $alignment,
                }
            ])
        >
            <input
                type="hidden"
                id="{{ $getId() }}"
                x-model="state"
                @if($multiple) x-init="init" @endif
            >
            <!-- Interact with the `state` property in Alpine.js -->
            @foreach($options as $value => $label)
                <button
                    type="button"
                    x-bind:class="@if($multiple) state.includes('{{ $value }}') @else state == '{{ $value }}' @endif
                            ? 'it-picker-item-picked {{ $activeBgColor }}'
                            : 'it-picker-item {{ $bgColor }}'"
                    x-on:click="setState('{{ $value }}')"
                >

                    @if(filled($images))
                        <img src="{{ $images[$value] }}" alt="{{ $label }}"
                             style="width:{{ $imageSize }}px; height:{{ $imageSize }}px;" draggable="false">
                    @endif

                    <div class="it-picker-item-label">
                        @isset($icons[$value])
                            <x-filament::icon
                                icon="{{ $icons[$value] }}"
                                class="h-4 w-4 mr-2"
                            />
                        @endisset
                        @if(!$imageOnly || !filled($images))
                            {{ $label }}
                        @endif
                    </div>
                    <div class="it-picker-checked-icon" style="right:-.5rem;top:-.5rem;"
                         x-show="state.includes('{{ $value }}')">
                            <span style="color:{{ $checkedColor }}">
                                <x-filament::icon
                                    icon="heroicon-S-check-circle"
                                />
                            </span>
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</x-dynamic-component>
