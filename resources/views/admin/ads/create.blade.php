@extends('layouts.dashboard')

@section('title', 'Create Ads')

@section('content')

    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col items-stretch grow gap-5 lg:gap-7.5">
        @csrf

        @error('ads')
            @php $message = $errors->first('ads'); @endphp
        @enderror


        <!-- Basic Settings Card -->
        <div class="card pb-2.5">
            <div class="card-header">
                <h3 class="card-title">Create Ads</h3>
            </div>
            <div class="card-body grid gap-5">
                <!-- Name Input -->
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56" for="name">Название</label>
                    <input type="text" class="input @error('name') is-invalid @enderror" name="name" id="name"
                        value="{{ old('name') }}" placeholder="Stemdev">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mobile Background -->
                <x-form.image_input name="desktop" label="Фон Desktop" />


                <x-form.image_input name="mobile" label="Фон Mobile" />

                <!-- Video Advertisement -->
                <div class="flex items-baseline">
                    <label class="form-label max-w-56" for="video">Видео реклама</label>
                    <div id="dropzone" onclick="document.getElementById('video').click()"
                        class="border border-dashed border-gray-400 rounded-lg p-3 bg-gray-50">
                        <div id="uploadVideoBox" class="flex flex-col items-center gap-2.5 ">
                            <img src="{{ asset('/images/fileupload.png') }}" alt="file-video" width="60" />
                            <p>Загрузите видео рекламы</p>
                        </div>

                        <video id="videoPreview" controls class="max-w-full w-12 hidden  h-auto rounded"
                            style="max-height: 200px;">
                            <source id="videoSource" src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <input type="file" class="input @error('video') is-invalid @enderror hidden" name="video"
                            id="video">
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Date Settings Card -->
            <div class="card pb-2.5">
                <div class="card-header">
                    <h3 class="card-title">Date Settings</h3>
                </div>
                <div class="card-body grid gap-5">
                    <!-- Start Date -->
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56" for="date_start">Дата начало</label>
                        <input type="datetime-local" class="input @error('date_start') is-invalid @enderror"
                            name="date_start" id="date_start" value="{{ old('date_start') }}">
                        @error('date_start')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56" for="date_end">Дата окончания</label>
                        <input type="datetime-local" class="input @error('date_end') is-invalid @enderror" name="date_end"
                            id="date_end" value="{{ old('date_end') }}">
                        @error('date_end')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            function handleVideo(file) {
                if (!file || !file.type.startsWith('video/')) {
                    alert("Iltimos, faqat video fayl yuklang!");
                    return;
                }
                document.getElementById('uploadVideoBox').classList.add('hidden');
                document.getElementById('videoPreview').classList.remove('hidden');
                if (file) {
                    document.getElementById('videoSource').src = URL.createObjectURL(file);
                    document.getElementById('videoPreview').load();
                }
            }


            document.getElementById('dropzone').addEventListener('drop', (event) => {
                handleVideo(event.target.files[0]);
            })


            document.getElementById('dropzone').addEventListener('dragover', (event) => {
                event.preventDefault();
                document.getElementById('dropzone').classList.add('dragover');
            });

            document.getElementById('dropzone').addEventListener('dragleave', () => {
                document.getElementById('dropzone').classList.remove('dragover');
            });

            document.getElementById('video').addEventListener('change', (event) => {
                handleVideo(event.target.files[0]);
            });


            // Handle custom "Select Image" button click
            document.querySelectorAll('.select-image').forEach(button => {
                button.addEventListener('click', () => {
                    const targetId = button.getAttribute('data-target');
                    const fileInput = document.getElementById(targetId);
                    if (fileInput) {
                        fileInput.click(); // Trigger file selection
                    }
                });
            });

            // Handle file input change (show preview)
            document.querySelectorAll('.image-upload').forEach(input => {
                input.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        const inputId = event.target.id;
                        const previewImg = document.getElementById(`${inputId}-preview`);
                        const deleteBtn = document.querySelector(
                            `.delete-button[data-target="${inputId}"]`);

                        if (previewImg && deleteBtn) {
                            previewImg.src = URL.createObjectURL(file);
                            previewImg.classList.remove('hidden');
                            deleteBtn.classList.remove('hidden');
                        }
                    }
                });
            });

            // Handle image deletion
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', () => {
                    const targetId = button.getAttribute('data-target');
                    const inputFile = document.getElementById(targetId);
                    const previewImg = document.getElementById(`${targetId}-preview`);

                    if (inputFile && previewImg) {
                        inputFile.value = ""; // Reset input value
                        previewImg.src = "#";
                        previewImg.classList.add('hidden');
                        button.classList.add('hidden');
                    }
                });
            });
        });
    </script>


@endsection
