@extends('layouts.dashboard')

@section('title', 'Translations')

@section('content')


    <div class="grid gap-5 lg:gap-7.5 xl:w-[38.75rem] mx-auto ">
        <div class="card pb-2.5">
            <div class="card-header" id="password_settings">
                <h3 class="card-title">
                    Add new words
                </h3>
            </div>
            <form
                action="{{ isset($translation) ? route('translations.update', $translation->id) : route('translations.store') }}"
                method="POST" class="card-body grid gap-5">
                @csrf
                @if (isset($translation))
                    @method('PUT')
                @endif
                @if ($errors->any())
                    <div class="mb-3 p-2 bg-red-100 text-red-600 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-600">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Text
                    </label>
                    <input class="input" name="text" placeholder="phrase" type="text"
                        value="{{ isset($translation) ? $translation->text : '' }}" />
                </div>


                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Key
                    </label>
                    <input class="input" type="text" name="key" placeholder="key: home, about, contact"
                        value="{{ isset($translation) ? $translation->key : '' }}" required>
                </div>
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Language code
                    </label>
                    <select class="select" name="language_code" id="code">
                        @foreach ($languages as $lang)
                            <option value="{{ $lang->code }}"
                                {{ old('language_code', isset($translation) && $translation->language_code == $lang->code ? 'selected' : '') }}>
                                {{ $lang->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button class="btn btn-primary">
                        {{ isset($translation) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>





    <div class="card ">
        <div class="card-header gap-2">
            <h3 class="card-title">
                Translations
            </h3>
        </div>
        <div class="card-table scrollable-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="min-w-40 text-center">
                            key
                        </th>
                        @foreach ($languages as $lang)
                            <th class="min-w-40 text-center">
                                {{ $lang->name }}
                            </th>
                        @endforeach
                        
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if (isset($translations))
                        @foreach ($translations as $translation)
                            <tr>
                                <td class="text-sm font-normal text-gray-800 text-start">
                                    {{ $translation->key }}
                                </td>
                                @foreach ($languages as $lang)
                                    <td class="text-sm font-normal text-gray-800">
                                        <form action="{{ route('translations_update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="language_code" value="{{ $lang->code }}">
                                            <input type="hidden" name="key" value="{{ $translation->key }}">
                                            <input type="text" onchange="this.form.submit()" class="input"
                                                name="value"
                                                value="{{ translate_strings($translation->key, $lang->code) }}">
                                        </form>
                                    </td>
                                @endforeach


                                {{-- <td class="">
                    <a href="{{ route('translations.index', ['translation' => $translation->id]) }}" class="btn btn-secondary">
                        Edit
                    </a>
                    <form action="{{ route('translations.destroy', $translation->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td> --}}
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>

@endsection
