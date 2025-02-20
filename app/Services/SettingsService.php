<?php

namespace App\Services;

use App\Enums\SettingType;
use App\Models\Settings;
use Illuminate\Http\UploadedFile;

class SettingsService
{
    /**
     * Retrieve all settings.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Settings::first();
    }

    /**
     * Create a new setting.
     *
     * @return \App\Models\Settings
     */
    public function store(array $data)
    {
        return Settings::create($data);
    }

    /**
     * Update an existing setting.
     *
     * @return void
     */
    public function updateSetting(array $data, Settings $setting)
    {
        // Example: update a text setting and/or file setting
        if (isset($data['site_name'])) {
            self::set('site_name', $data['site_name'], SettingType::TEXT);
        }

        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            $path = $data['logo']->store('logos', 'public');
            self::set('logo', $path, SettingType::FILE);
        }

        // Additional fields can be updated directly on the model if needed
        $setting->update($data);
    }
}
