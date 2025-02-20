<?php

namespace App\Enums;

enum SettingType: string
{
    case TEXT = 'text';
    case FILE = 'file';
    case BOOLEAN = 'boolean';
    case NUMBER = 'number';

    public static function values(): array
    {
        return [
            self::TEXT->value,
            self::FILE->value,
            self::BOOLEAN->value,
            self::NUMBER->value,
        ];
    }

    public static function selectOptions(): array
    {
        return array_map(fn ($type) => ['label' => ucfirst($type->name), 'value' => $type->value], self::cases());
    }
}
