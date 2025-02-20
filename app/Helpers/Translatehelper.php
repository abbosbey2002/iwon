<?php

use App\Models\Settings;
use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

if (! function_exists('translate')) {
    function translate(string $key, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $cacheKey = "translation_{$key}_{$locale}";

        return Cache::rememberForever($cacheKey, function () use ($key, $locale) {
            return Translation::query()
                ->with('language')
                ->whereHas('language', fn ($query) => $query->where('code', $locale))
                ->where('key', $key)
                ->value('text') ?? $key;  // Return key if no translation found
        });
    }
}

if (! function_exists('site_settings')) {
    function site_settings($key = '')
    {

        $settings = Cache::rememberForever('site_settings_all', function () {
            return Settings::first(); // Retrieve the first settings row
        });

        return $key ? ($settings?->$key ?? null) : $settings;
    }
}

if (! function_exists('translate_strings')) {
    function translate_strings(?string $key = null, ?string $locale = null)
    {
        if (! $key || ! $locale) {
            return '';
        }

        $cacheKey = "translate_strings{$locale}";

        // Cache all translations for a specific locale
        // $translations = Cache::rememberForever($cacheKey, function () use ($locale) {
        $translations = Translation::where('language_code', $locale)
            ->pluck('text', 'key')  // Key-Value pair
            ->toArray();
        // });

        return $translations[$key] ?? '';  // Return translation or empty string
    }
}
