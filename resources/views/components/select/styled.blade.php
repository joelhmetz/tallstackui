@php
    $computed  = $attributes->whereStartsWith('wire:model');
    $directive = array_key_first($computed->getAttributes());
    $property  = $computed[$directive];
    $error     = $errors->has($property);
    $customize = tasteui_personalization('select.styled', $customization());
@endphp

<x-wrapper.select :$label :$error :$computed :$hint>
    @if (!str($directive)->contains('.live'))
        <x-slot:alpine>
            tasteui_selectStyled(@entangle($property), @js($searchable), @js($multiple), @js($selectable !== []), @js($selectable), @js($options), @js($placeholder))
        </x-slot:alpine>
    @else
        <x-slot:alpine>
            tasteui_selectStyled(@entangle($property).live, @js($searchable), @js($multiple), @js($selectable !== []), @js($selectable), @js($options), @js($placeholder))
        </x-slot:alpine>
    @endif
    <x-slot:header>
        <div class="flex gap-2">
            <template x-if="(!multiple && !empty) || quantity === 0">
                <span @class(['truncate', 'text-red-500' => $error]) x-bind:class="{ 'text-gray-400': empty, 'text-gray-600': !empty }" x-text="placeholder"></span>
            </template>
            <template x-if="multiple && quantity > 0">
                <span x-text="quantity"></span>
            </template>
            <div class="truncate" x-show="multiple">
                <template x-for="(selected, index) in selecteds" :key="selected[selectable.label] ?? selected">
                    <a href="#" class="cursor-pointer" x-on:click="clear(selected);">
                        <div @class($customize['multiple'])>
                            <span x-text="selected[selectable.label] ?? selected"></span>
                            <x-icon name="x-mark" @class($customize['icon']) />
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </x-slot:header>
</x-wrapper.select>
