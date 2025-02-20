<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
        $languages = Language::all();
        $translations = Translation::with('language')->get();

        $language = null;
        $translation = null;

        if ($request->has('language')) {
            $language = Language::find($request->language);
        }

        if ($request->has('edit_translation')) {
            $translation = Translation::find($request->edit_translation);
        }

        return view('admin.languages.languages', compact('languages', 'translations', 'language', 'translation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:languages',
            'name' => 'required|string',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Allow only images
        ]);

        // Upload Icon Image
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');  // Store in storage/app/public/icons
        } else {
            $iconPath = null;
        }

        // Create Language with the icon path
        Language::create([
            'code' => $request->code,
            'name' => $request->name,
            'icon' => $iconPath,
        ]);

        return redirect()->route('admin.languages.index')->with('success', 'Language added successfully.');
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'code' => 'required|string|unique:languages,code,'.$language->id,
            'name' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Optional on update
        ]);

        // Upload new icon if provided
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($language->icon) {
                Storage::disk('public')->delete($language->icon);
            }
            $iconPath = $request->file('icon')->store('icons', 'public');
        } else {
            $iconPath = $language->icon;  // Keep the existing icon if not updated
        }

        $language->update([
            'code' => $request->code,
            'name' => $request->name,
            'icon' => $iconPath,
        ]);

        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        $language->delete();

        return redirect()->route('admin.languages.index')->with('success', 'Language deleted successfully.');
    }

    public function edit(Language $language)
    {
        return response()->json($language);
    }
}
