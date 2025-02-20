@extends('layouts.dashboard')

@section('title', __('auth.voucher_confirmation'))

@section('content')

    <!-- Adjust the route and pass $ad or $ad->id for editing -->
    <form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col items-stretch grow gap-5 lg:gap-7.5">
        @csrf
        @method('PUT') <!-- Use PUT for editing -->

        @error('ads')
            @php $message = $errors->first('ads'); @endphp
        @enderror

        <!-- Basic Settings Card -->
        <div class="card pb-2.5">
            <div class="card-header">
                <h3 class="card-title">Edit Ads</h3>
            </div>
            <div class="card-body grid gap-5">
                <!-- Name Input -->
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56" for="name">Название</label>
                    <input type="text" class="input @error('name') is-invalid @enderror" name="name" id="name"
                        value="{{ old('name', $ad->name) }}" placeholder="Stemdev">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mobile Background -->
                <x-form.image_input name="mobile" label="Фон Mobile" value="{{ old('mobile', $ad->mobile) }}" />



                <!-- Desktop Background -->
                <x-form.image_input name="desktop" label="Фон Desktop" value="{{ old('desktop', $ad->desktop) }}" />

                <!-- Video Advertisement -->
                <div class="flex flex-col gap-4">
                    <!-- Upload Section -->
                    <div class="flex items-  flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56" for="video">Видео реклама</label>
                        <!-- Preview Section -->
                        @if (isset($ad) && $ad->video)
                            <div class="video-preview-container relative">
                                <div class="border rounded-lg p-3 bg-gray-50">
                                    <div class="flex justify-between py-2 items-center">
                                        <h4 class="text-sm font-medium ">Предварительный просмотр</h4>
                                        <button type="button" onclick="document.getElementById('video').click()"
                                            class=" px-2 py-1  btn btn-success">изменить видео</button>
                                    </div>
                                    <video id="videoPreview" controls class="max-w-full h-auto rounded"
                                        style="max-height: 300px;">
                                        <source id="videoSource" src="{{ asset('storage/' . $ad->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        @endif
                        <input type="file" style="display: none"
                            class="input @error('video')  hidden is-invalid @enderror" name="video" id="video"
                            accept="video/*" onchange="handleVideoPreview(this)">
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
                    <input type="datetime-local" class="input @error('date_start') is-invalid @enderror" name="date_start"
                        id="date_start" value="{{ old('date_start', $ad->date_start) }}">
                    @error('date_start')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56" for="date_end">Дата окончания</label>
                    <input type="datetime-local" class="input @error('date_end') is-invalid @enderror" name="date_end"
                        id="date_end" value="{{ old('date_end', $ad->date_end) }}">
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
        function handleVideoPreview(input) {
            if (input.files && input.files[0]) {
                let file = input.files[0];
                let videoUrl = URL.createObjectURL(file); // Faylni vaqtincha URLga aylantiramiz

                let videoSource = document.getElementById('videoSource');
                let videoPreview = document.getElementById('videoPreview');

                videoSource.src = videoUrl; // <source> elementining src ni yangilaymiz
                videoPreview.load(); // Yangi faylni yuklash uchun video elementni yangilaymiz
            }
        }
    </script>

@endsection
