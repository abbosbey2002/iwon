@props(['name' => '', 'label', 'value' => ''])

{{-- <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
    <label class="form-label max-w-56" for="{{ $name ?? '' }}">{{ $label ?? '' }}</label>
    <div class="relative flex">
        <div class="flex flex-col">
            <!-- Hidden File Input -->
            <input type="file" class="image-upload input hidden @error($name) is-invalid @enderror"
                name="{{ $name ?? '' }}" id="{{ $name ?? '' }}" accept="image/*">

            <!-- Button to trigger file selection -->
            <button type="button" class="btn btn-primary select-image p-1" data-target="{{ $name ?? '' }}">Выбрать
                изображение</button>

            <!-- Delete Image Button -->
            <button type="button" class="{{ $value ? '' : 'hidden' }} btn btn-danger mt-2 delete-button"
                data-target="{{ $name ?? '' }}">Удалить
                изображение</button>
        </div>

        <!-- Image Preview -->
        <img id="{{ $name ?? '' }}-preview" src="{{ asset('storage/' . $value ?? '') }}" alt="Image Preview"
            class="{{ $value ? '' : 'hidden' }} ml-5 border rounded" style="max-width: 150px; max-height: 150px;">

    </div>
    @error($name)
        <div class="text-red">{{ $message }}</div>
    @enderror
</div> --}}


<div class="image-input image-input-outline" id="kt_image_1">
    <div class="image-input-wrapper" style="background-image: url({{ asset('/images/fileupload.png') }})">
    </div>

    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change"
        data-toggle="tooltip" title="" data-original-title="Change avatar">
        <i class="fa fa-pen icon-sm text-muted"></i>
        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
        <input type="hidden" name="profile_avatar_remove" />
        test
    </label>

    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel"
        data-toggle="tooltip" title="Cancel avatar">
        <i class="ki ki-bold-close icon-xs text-muted"></i>
    </span>
</div>


<script>
    // var avatar1 = new KTImageInput('kt_image_1');
</script>
