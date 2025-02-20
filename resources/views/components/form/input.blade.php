@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'type' => \App\Enums\SettingType::TEXT->value, // Default type
])

@php
    use App\Enums\SettingType;

    // Agar kiritilgan type SettingType enum ichida bo‘lmasa, default 'text' ishlatiladi
    $validType = in_array($type, SettingType::values()) ? $type : SettingType::TEXT->value;
@endphp

<div class="flex items-baseline flex-wrap">
    @if ($label)
        <label class="form-label max-w-56 mb-1" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif

    @if ($validType === SettingType::BOOLEAN->value)
        <input type="checkbox" class="{{ $validType }}" name="{{ $name }}" id="{{ $name }}"
            {{ $value ? 'checked' : '' }}>
    @elseif($validType === SettingType::FILE->value)
        <x-form.image_input name="{{ $name }}" label="{{ $label }}" value="{{ $value }}" />
        {{$value}}  {{$name}}
        {{-- <input type="file" name="{{ $name }}" accept="image/*" id="{{ $name }}"> --}}
        <img class="border mx-auto" width="100px" src="{{ asset($value) }}" alt="image">
    @elseif($validType === SettingType::NUMBER->value)
        <input type="number" class="input" pattern="[0-9]" name="{{ $name }}" id="{{ $name }}"
            value="{{ $value }}">
    @else
        <input type="text" class="input" name="{{ $name }}" id="{{ $name }}"
            value="{{ $value }}">
    @endif
</div>
