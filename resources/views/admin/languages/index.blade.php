
@extends('layouts.dashboard')

@section('title',  __('auth.voucher_confirmation') )

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-3">Manage Languages & Translations  {{ translate('express') }}</h1>
    <!-- Add/Edit Language Form -->
    <div class="mb-4 p-3 bg-white shadow rounded">
        <h2 class="text-lg font-semibold mb-2">{{ isset($language) ? 'Edit Language' : 'Add New Language' }}</h2>
        <form action="{{ isset($language) ? route('admin.languages.update', $language->id) : route('admin.languages.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($language))
                @method('PUT')  
            @endif
            <div class="mb-3">
                <label class="block text-sm">Language Code</label>
                <input type="text" name="code" class="border p-1 w-full text-sm" 
                       value="{{ isset($language) ? $language->code : '' }}" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm">Language Name</label>
                <input type="text" name="name" class="border p-1 w-full text-sm" 
                       value="{{ isset($language) ? $language->name : '' }}" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm">Language Image</label>
                <input type="file" accept="image/*" name="icon" class="border p-1 w-full text-sm">
                @if(isset($language) && $language->icon)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$language->icon) }}" alt="Language Icon" class="w-16 h-16 rounded">
                    </div>
                @endif
            </div>
            <button type="submit" class="bg-{{ isset($language) ? 'blue' : 'green' }}-500 text-white px-3 py-1 rounded text-sm">
                {{ isset($language) ? 'Update' : 'Save' }}
            </button>
        </form>
    </div>

    <div class="mb-4 p-3 bg-white shadow rounded">
        <h2 class="text-lg font-semibold mb-4">Languages List</h2>
        
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2 text-left">#</th>
                    <th class="border border-gray-300 p-2 text-left">Language</th>
                    <th class="border border-gray-300 p-2 text-left">Code</th>
                    <th class="border border-gray-300 p-2 text-left">Icon</th>
                    <th class="border border-gray-300 p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($languages as $index => $language)
                    <tr class="border border-gray-300">
                        <td class="p-2">{{ $index + 1 }}</td>
                        <td class="p-2">{{ $language->name }}</td>
                        <td class="p-2">{{ $language->code }}</td>
                        <td class="p-2">
                            @if($language->icon)
                                <img src="{{ asset('storage/'.$language->icon) }}" alt="Language Icon" class="w-10 h-10 rounded">
                            @endif
                        </td>
                        <td class="p-2">
                            <a href="{{ route('admin.languages.index', ['language' => $language->id]) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.languages.destroy', $language->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-sm" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    

   <!-- Add/Edit Translation Form -->
   <div class="mb-4 p-3 bg-white shadow rounded">
    <h2 class="text-lg font-semibold mb-2">{{ isset($translation) ? 'Edit Translation' : 'Add New Translation' }}</h2>
    
    @if ($errors->any())
        <div class="mb-3 p-2 bg-red-100 text-red-600 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (isset($translation))
    <form action="{{route('admin.translations.update', $translation->id)}}" method="POST">
    @else
    <form action="{{ route('admin.translations.store') }}" method="POST">
    @endif
        @csrf
        @if(isset($translation))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label class="block text-sm">Translation Key</label>
            <input type="text" name="key" class="border p-1 w-full text-sm" value="{{ old('key', isset($translation) ? $translation->key : '') }}" required>
        </div>
        <div class="mb-3">
            <label class="block text-sm">Select Language</label>
            <select name="language_code" class="border p-1 w-full text-sm" required>
                @foreach($languages as $lang)
                    <option value="{{ $lang->code }}" {{ old('language_code', isset($translation) && $translation->language_code == $lang->code ? 'selected' : '') }}>{{ $lang->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="block text-sm">Translation Text</label>
            <input type="text" name="text" class="border p-1 w-full text-sm" value="{{ old('text', isset($translation) ? $translation->text : '') }}" required>
        </div>
        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded text-sm">
           @if (isset($translation))
               Update  
               @else
               Save
           @endif
        </button>
    </form>
</div>

    <!-- Translation List -->
    <table class="mt-3 w-full border-collapse border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-1">Key</th>
                <th class="border p-1">Language</th>
                <th class="border p-1">Text</th>
                <th class="border p-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($translations as $translation)
                <tr>
                    <td class="border p-1">{{ $translation->key }}</td>
                    <td class="border p-1">{{ $translation->language->name }}</td>
                    <td class="border p-1">{{ $translation->text }}</td>
                    <td class="border p-1">
                        <a href="{{ route('admin.languages.index', ['edit_translation' => $translation->id]) }}" class="text-blue-500 text-xs">Edit</a>
                        <form action="{{ route('admin.translations.destroy', $translation->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-1 text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection