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
        {{ $attributes->merge($getExtraAttributes())->class(['ic-fo-picker']) }}
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
            class="flex flex-wrap gap-2 justify-around"
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
                            ? 'px-2 py-1 rounded shadow {{ $activeBgColor }} text-white relative'
                            : 'px-2 py-1 rounded text-gray-900 shadow relative {{ $bgColor }}'"
                    x-on:click="setState('{{ $value }}')"
                >

                    @if(filled($images))
                        <img src="{{ $images[$value] }}" alt="{{ $label }}"
                             style="width:{{ $imageSize }}px; height:{{ $imageSize }}px;" draggable="false">
                    @endif

                    <div class="flex items-center text-center">
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
                    <div class="absolute -right-2 -top-2" style="right:-.5rem;top:-.5rem;"
                         x-show="state.includes('{{ $value }}')">
                            <span style="color:rgb({{ $checkedColor }})">
                                <x-filament::icon
                                    icon="heroicon-s-check-circle"
                                    class="h-4 w-4"
                                />
                            </span>
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</x-dynamic-component>
