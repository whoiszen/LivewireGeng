<?php /**
 * Simple anonymous Blade component for text inputs.
 *
 * Usage examples:
 *  <x-text-input wire:model="name" />
 *  <x-text-input type="search" wire:model.live="searchQuery" placeholder="Search..." class="w-64" />
 */ ?>
<input
    {{ $attributes->merge([
        'type' => $type ?? 'text',
        'placeholder' => $placeholder ?? '',
        'class' => trim(($attributes->get('class') ?? '') . ' border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'),
    ]) }}
/>
