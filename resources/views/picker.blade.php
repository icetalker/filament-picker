@php
    use Filament\Support\Colors\Color;

    $options = $getOptions();
    $icons = $getIcons();
    $images = $getImages();
    $imageOnly = $getImageOnly();
    $imageSize = $getImageSize() ?: ['50px', '50px'];
    $imageObjectFit = $getImageObjectFit();
    $imageAspecRatio = $getImageAspecRatio();
    $checkedColor = Color::Green[500];
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
        >
            <input
                type="hidden"
                id="{{ $getId() }}"
                x-model = "state"
            >

            <x-filament::grid
                :default="$getColumns('default')"
                :sm="$getColumns('sm')"
                :md="$getColumns('md')"
                :lg="$getColumns('lg')"
                :xl="$getColumns('xl')"
                :two-xl="$getColumns('2xl')"
            >
                <!-- Interact with the `state` property in Alpine.js -->
                @foreach($options as $value => $label)
                    <button 
                        type="button"
                        x-bind:class="
                            state == '{{ $value }}'
                                ? 'px-2 py-1 rounded shadow bg-primary-500 text-white relative'
                                : 'px-2 py-1 rounded text-gray-900 shadow relative dark:bg-gray-700'
                            "
                        x-on:click="setState('{{ $value }}')"
                    > 
                        @if(filled($images))
                            <img src="{{ $images[$value] }}" alt="{{ $label }}" 
                                style="width:{{ $imageSize[0] }}; height:{{ $imageSize[1] }}; object-fit:{{ $imageObjectFit }}; aspect-ratio: {{ $imageAspecRatio }};">
                        @endif

                        <div class="flex items-center text-center">
                            @if(@isset($icons[$value]))
                            <x-filament::icon
                                icon="{{ $icons[$value] }}"
                                class="h-4 w-4 mr-2"
                            />
                            @endif
                            @if(!$imageOnly||!filled($images))
                            {{ $label }}
                            @endif
                        </div>
                        <div class="absolute -right-2 -top-2" style="right:-.5rem;top:-.5rem;" x-show="state == '{{ $value }}'">
                            <span style="color:rgb({{ $checkedColor }})">
                                <x-filament::icon
                                    icon="heroicon-s-check-circle"
                                    class="h-4 w-4"
                                />
                            </span>
                        </div>
                        
                    </button>
                @endforeach
            </x-filament::grid>
        </div>

    </div>
</x-dynamic-component>

