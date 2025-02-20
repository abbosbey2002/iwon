<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    protected SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Display a listing of the settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $setting = $this->settingsService->getAll();

        return view('admin.settings.settings', compact('setting'));
    }

    /**
     * Store a newly created setting in storage.
     *
     * @param  \App\Http\Requests\StoreSettingsRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'site_logo' => 'nullable|image|mimes:webp|max:2048',
            'customer_logo' => 'nullable|image|mimes:webp|max:2048',
            'google_play_link' => 'nullable|url',
            'app_store_link' => 'nullable|url',
            'google_play_image' => 'nullable|image|mimes:webp|max:2048',
            'app_store_image' => 'nullable|image|mimes:webp|max:2048',
            'expired_date' => 'nullable|integer',
        ]);

        $settings = Settings::findOrFail($id);

        // Handle Image Uploads (Replacing Old Images)
        // Handle Image Uploads (Replacing Old Images)
        if ($request->hasFile('site_logo')) {
            if (! empty($settings->site_logo)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $settings->site_logo));
            }
            $path = $request->file('site_logo')->store('settings', 'public');
            $settings->site_logo = "storage/$path"; // Store path with "storage/"
        }

        if ($request->hasFile('customer_logo')) {
            if (! empty($settings->customer_logo)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $settings->customer_logo));
            }
            $path = $request->file('customer_logo')->store('settings', 'public');
            $settings->customer_logo = "storage/$path";
        }

        if ($request->hasFile('google_play_image')) {
            if (! empty($settings->google_play_image)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $settings->google_play_image));
            }
            $path = $request->file('google_play_image')->store('settings', 'public');
            $settings->google_play_image = "storage/$path";
        }

        if ($request->hasFile('app_store_image')) {
            if (! empty($settings->app_store_image)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $settings->app_store_image));
            }
            $path = $request->file('app_store_image')->store('settings', 'public');
            $settings->app_store_image = "storage/$path";
        }

        // Assign other fields
        $settings->google_play_link = $request->google_play_link;
        $settings->app_store_link = $request->app_store_link;
        $settings->expired_date = $request->expired_date;

        $settings->save();

        Cache::forget('site_settings_all');

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_logo' => 'nullable|image|mimes:webp|max:2048',
            'customer_logo' => 'nullable|image|mimes:webp|max:2048',
            'google_play_link' => 'nullable|url',
            'app_store_link' => 'nullable|url',
            'google_play_image' => 'nullable|image|mimes:webp|max:2048',
            'app_store_image' => 'nullable|image|mimes:webp|max:2048',
            'expired_date' => 'nullable|integer',
        ]);

        $settings = new Settings;

        // Handle Image Uploads (Replacing Old Images)
        if ($request->hasFile('site_logo')) {
            if (! empty($settings->site_logo)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $settings->site_logo));
            }
            $path = $request->file('site_logo')->store('settings', 'public');
            $settings->site_logo = "storage/$path"; // Store formatted path
        }

        if ($request->hasFile('customer_logo')) {
            if (! empty($settings->customer_logo)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $settings->customer_logo));
            }
            $path = $request->file('customer_logo')->store('settings', 'public');
            $settings->customer_logo = "storage/$path";
        }

        if ($request->hasFile('google_play_image')) {
            if (! empty($settings->google_play_image)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $settings->google_play_image));
            }
            $path = $request->file('google_play_image')->store('settings', 'public');
            $settings->google_play_image = "storage/$path";
        }

        if ($request->hasFile('app_store_image')) {
            if (! empty($settings->app_store_image)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $settings->app_store_image));
            }
            $path = $request->file('app_store_image')->store('settings', 'public');
            $settings->app_store_image = "storage/$path";
        }

        // Assign other fields
        $settings->google_play_link = $request->google_play_link;
        $settings->app_store_link = $request->app_store_link;
        $settings->expired_date = $request->expired_date;

        $settings->save();

        Cache::forget('site_settings_all');

        return redirect()->back()->with('success', 'Settings saved successfully!');
    }
}
