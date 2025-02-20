@extends('layouts.dashboard')

@section('title', 'Language')

@section('content')

    <div class="container-fixed mb-4">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Languages</h1>
            <button class="btn btn-primary" id="add-language-btn" data-modal-toggle="#add-language">
                Add Language
            </button>
        </div>
    </div>
    <div class="container-fixed">
        <div class="card">
            <div class="card-table scrollable-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="min-w-40">
                                Name
                            </th>
                            <th class="min-w-40 text-center">
                                Code
                            </th>
                            <th class="min-w-40 text-center">
                                Icon
                            </th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($languages))
                            @foreach ($languages as $lang)
                                <tr>
                                    <td class="text-sm font-normal text-gray-800">
                                        {{ $lang->name }}
                                    </td>
                                    <td class="text-sm font-normal text-gray-800 text-center">
                                        {{ $lang->code }}
                                    </td>
                                    <td class="text-sm font-normal text-gray-800 text-center">
                                        <img class="mx-auto w-10 h-auto" src="{{ asset('storage/' . $lang->icon) }}"
                                            alt="{{ $lang->name }}">
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);"
                                            data-url="{{ route('admin.languages.edit', ['language' => $lang->id]) }}"
                                            class="btn btn-secondary js-edit-language">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.languages.destroy', $lang->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>





    <div class="modal" data-modal="true" id="add-language">
        <div class="modal-content max-w-[600px] top-[15%]">
            <div class="modal-header py-4 px-5">
                <h2>Add Language</h2>
                <button id="clearformbtn" class="btn btn-sm btn-icon btn-light btn-clear shrink-0"
                    data-modal-dismiss="true">
                    <i class="ki-filled ki-cross">
                    </i>
                </button>
            </div>
            <div class="modal-body p-0">
                <form action="{{ route('admin.languages.store') }}" id="add-language-form" method="POST"
                    enctype="multipart/form-data" class="card-body grid gap-5">
                    @csrf
                    @if ($errors->any())
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const addLanguageBtn = document.getElementById('add-language-btn');
                                if (addLanguageBtn) {
                                    addLanguageBtn.click();
                                    console.log(addLanguageBtn);
                                }
                            });
                        </script>
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
                            Language Code
                        </label>
                        <input class="input" name="code" placeholder="Your language code: us, en, ru" type="text"
                            value="{{ isset($language) ? $language->code : '' }}" />
                    </div>


                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Language Name
                        </label>
                        <input class="input" type="text" name="name"
                            placeholder="Language Name: English, Russian, Uzbek"
                            value="{{ isset($language) ? $language->name : '' }}" required>
                    </div>
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Language icon
                        </label>
                        <input type="file" accept="image/*" name="icon" class="" id="icon" />
                        <img width="mx-auto" id="iconImg" src="" alt="">
                    </div>

                    <div class="flex justify-end">
                        <button class="btn btn-primary">
                            {{ isset($language) ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function openForm() {
                const addLanguageBtn = document.getElementById('add-language-btn')
                document.getElementById('add-language-btn').click()
                if (addLanguageBtn) {
                    addLanguageBtn.click();
                    console.log(document.getElementById('add-language-btn') + 'working');
                }
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


            document.getElementById('clearformbtn').addEventListener('click', () => {
                document.getElementById('add-language-form').reset();
                document.getElementById('add-language-form').action =
                    "{{ route('admin.languages.store') }}";
                document.getElementById('iconImg').src = '';
            });

            // Edit tugmachalarini tanlab olamiz (class = js-edit-language)
            const editButtons = document.querySelectorAll('.js-edit-language');

            editButtons.forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event.preventDefault(); // sahifa refresh bo'lishining oldini olamiz

                    // data-url atributidan route’ni olamiz
                    const url = this.getAttribute('data-url');

                    let updateUrlTemplate =
                        "{{ route('admin.languages.update', ['language' => 'LANGUAGE_ID']) }}";

                    // Agar GET so'rov bo'lsa oddiy fetch qilamiz:
                    fetch(url)
                        .then(response => response
                            .json()) // yoki response.text() - backend javobiga bog'liq
                        .then(data => {
                            // data ichida backenddan kelgan ma'lumot bo'ladi
                            console.log(data);
                            document.querySelector('input[name="code"]').value = data.code;
                            document.querySelector('input[name="name"]').value = data.name;
                            document.getElementById('iconImg').src =
                                "{{ asset('storage') }}" + '/' + data.icon;
                            const updatedUrl = updateUrlTemplate.replace('LANGUAGE_ID', data
                                .id);

                            document.getElementById('add-language-form').action = updatedUrl
                            // Masalan: alert(`Language: ${data.title}`);

                            openForm()
                        })
                        .catch(error => {
                            console.error('Xatolik:', error);
                        });
                });
            });

        });
    </script>

@endsection
