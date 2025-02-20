<?php

namespace App\Http\Controllers;

use App\Http\Requests\Traslations\StoreTranslationRequest;
use App\Http\Requests\Traslations\UpdateTranslationRequest;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        $translation = null;
        if ($request->has('translation')) {
            $translation = Translation::find($request->translation);
        }
        $languages = Language::all();
        $translations = Translation::where('language_code', app()->getLocale())->get();

        // dd($translations);
        return view('admin.languages.translations', compact('translations', 'languages', 'translation'));
    }

    public function create()
    {
        $languages = Language::all();

        return view('admin.translations.create', compact('languages'));
    }

    public function store(StoreTranslationRequest $request)
    {
        Translation::create($request->validated());

        return redirect()->route('translations.index')->with('success', 'Translation added successfully.');
    }

    public function show(Translation $translation)
    {
        return view('admin.translations.show', compact('translation'));
    }

    public function update(UpdateTranslationRequest $request, Translation $translation)
    {
        dd($request->all());
        $translation->update($request->validated());

        return redirect()->route('translations.index')->with('success', 'Translation updated successfully.');
    }

    public function destroy(Translation $translation)
    {
        $translation->delete();

        return redirect()->route('translations.index')->with('success', 'Translation deleted successfully.');
    }

    /**
     * Update or create a translation string based on the request data.
     *
     * This function attempts to find a translation matching the given key and language code.
     * If found, it updates the translation text; otherwise, it creates a new translation entry.
     * After processing, it redirects back to the previous page.
     *
     * @param  Request  $request  The HTTP request containing 'key', 'language_code', and 'value'.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatestring(Request $request)
    {
        $translation = Translation::updateOrCreate(
            [
                'key' => $request->key,
                'language_code' => $request->language_code,
            ],
            [
                'text' => $request->value,
            ]
        );

        return redirect()->back();
    }
}
