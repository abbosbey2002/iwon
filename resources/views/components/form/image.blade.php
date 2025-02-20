@props(['label', 'name', 'value' => null])

<div class="flex flex-col gap-2">
    <label class="font-semibold">{{ $label }}</label>

    <!-- Image Preview -->
    <div  x-data="{ imagePreview: '{{ $value ? asset("$value") : "" }}', imageFile: null }" class="relative w-[230px]">
        <input type="file" name="{{ $name }}" id="{{ $name }}" accept="image/webp"
               @change="const reader = new FileReader();
                        reader.onload = (e) => imagePreview = e.target.result;
                        reader.readAsDataURL($event.target.files[0]);
                        imageFile = $event.target.files[0];"
               class="hidden">

        <!-- Preview Container -->
        <div class="border border-gray-300 rounded-lg p-2 flex items-center justify-center" 
             x-show="imagePreview || imageFile" style="min-height: 100px;">
            <img :src="imagePreview" alt="Preview" class="max-h-32 object-cover rounded-lg" x-show="imagePreview">
        </div>

        <!-- Remove Button -->
        <button type="button" x-show="imagePreview || imageFile" @click="imagePreview = ''; imageFile = null; document.getElementById('{{ $name }}').value = '';"
                class="absolute top-0 right-0 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
            ✕
        </button>
    </div>

    <!-- Upload Button -->
    <label for="{{ $name }}" class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-md mt-2 text-center inline-block">
        Choose Image
    </label>
</div>
