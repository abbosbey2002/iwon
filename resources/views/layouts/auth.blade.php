<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'iWon Mobil Ilovasi')</title>
    <!-- Tailwind + your compiled app CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset(site_settings('site_logo')) }}" type="image/x-icon">
    <!-- Alpine.js (Needed only if you use the Alpine approach) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <!-- Container -->
    <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg max-w-lg w-full text-center space-y-6">

        <!-- Header: Logo & Original Select -->
        <div class="flex justify-between items-center mb-6">
            <!-- Left: Site Logo -->
            <a href="/">
                <img src="{{ asset(site_settings('site_logo')) }}" width="130" alt="SOLO Wi-Fi Logo" class="app-logo">
            </a>

            <!-- Right: Native Select (will be replaced or hidden by Vanilla JS) -->
            <form action="{{ route('set-locale') }}" class="hidden" method="POST">
                @csrf
                <select name="language" class="bg-gray-700 my-select  text-white px-3 outline-none py-2 rounded-md">
                    @foreach ($languages as $lang)
                        <!-- Store the flag path in data-icon so vanilla JS can read it -->
                        <option value="{{ $lang->code }}" data-icon="{{ $lang->icon }}"
                            @if (app()->getLocale() === $lang->code) selected @endif>
                            {{ $lang->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <div x-data="{
                open: false,
                languages: [
                    @foreach ($languages as $lang)
                    { 
                      code: '{{ $lang->code }}', 
                      name: '{{ $lang->name }}', 
                      icon: '{{ asset('storage/' . $lang->icon) }}' 
                    }, @endforeach
                ],
                selected: '{{ app()->getLocale() }}',
            }" class="relative inline-block text-left">
                <!-- Trigger button -->
                <button @click="open = !open" type="button"
                    class="inline-flex justify-between items-center  bg-gray-700 text-white px-3 py-2 rounded-md">
                    <!-- Selected icon & name -->
                    <div class="flex items-center">
                        <img :src="(languages.find(lang => lang.code === selected)?.icon || 'flags/en.png')"
                            alt="Flag" class="w-5 h-5 mr-2 object-contain" />
                        <span x-text="languages.find(lang => lang.code === selected)?.name || 'Select'"></span>
                    </div>

                    <!-- Dropdown arrow -->
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div x-show="open" @click.outside="open = false"
                    class="absolute mt-1 bg-gray-700 text-white shadow rounded z-10" style="display: none;">
                    <template x-for="lang in languages" :key="lang.code">
                        <button
                            @click="
                                selected = lang.code;
                                open = false;
                                changeLocale(lang.code);
                            "
                            type="button" class="flex items-center w-full px-3 py-2 text-left hover:bg-gray-500">
                            <img :src="lang.icon" alt="Flag" class="w-5 h-5 mr-2 object-contain" />
                            <span x-text="lang.name"></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Customer Log -->
        <div class="flex justify-center mb-6">
            <img src="{{ site_settings('customer_logo') }}" width="130" alt="iWon Logo" class="app-logo">
        </div>

        <!-- Page Content -->
        @yield('content')
    </div>




    <!--
        1) ALPINE.JS APPROACH
           This shows how to build a custom dropdown with images in each item
           using Alpine.js.
           If you *only* want the Vanilla JS approach, remove this block entirely.
    -->


    <!--
        2) VANILLA JS APPROACH
           This snippet:
             - Hides the original <select>
             - Builds a custom dropdown with flags
             - Updates the hidden <select> on selection
    -->
    <script>
        function changeLocale(localeCode) {
            // Example fetch request to your set-locale route
            fetch('{{ route('set-locale') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    language: localeCode
                })
            }).then(() => window.location.reload());
        }

        document.addEventListener("DOMContentLoaded", function() {
            const originalSelect = document.querySelector(".my-select");
            if (!originalSelect) return; // Safeguard if there's no .my-select

            // 1) Hide the native <select>
            originalSelect.style.display = "none";

            // 2) Create a container for our custom dropdown
            const container = document.createElement('div');
            container.classList.add('relative', 'inline-block', 'text-left', 'mt-6');

            // 3) Create the trigger button
            const button = document.createElement('button');
            button.type = 'button';
            button.classList.add(
                'inline-flex', 'justify-between', 'items-center',
                'bg-gray-700', 'text-white', 'px-3', 'py-2', 'rounded-md'
            );

            // Display the initially selected option text
            const selectedOption = originalSelect.options[originalSelect.selectedIndex];
            button.textContent = selectedOption ? selectedOption.textContent : 'Select...';

            container.appendChild(button);

            // 4) Create the dropdown menu container
            const dropdown = document.createElement('div');
            dropdown.classList.add('absolute', 'mt-1', 'w-48', 'bg-white', 'shadow', 'rounded', 'z-10');
            dropdown.style.display = 'none'; // Start hidden
            container.appendChild(dropdown);

            // 5) Populate dropdown items from the original <select>
            Array.from(originalSelect.options).forEach((option) => {
                const item = document.createElement('button');
                item.type = 'button';
                item.classList.add(
                    'flex', 'items-center', 'w-full',
                    'px-3', 'py-2', 'text-left', 'hover:bg-gray-100'
                );

                // a) Create an <img> for the icon from data-icon
                const iconURL = option.getAttribute('data-icon');
                if (iconURL) {
                    const img = document.createElement('img');
                    img.src = '/storage/' + iconURL;
                    img.classList.add('w-5', 'h-5', 'mr-2', 'object-contain');
                    item.appendChild(img);
                }

                // b) Language text
                const textSpan = document.createElement('span');
                textSpan.textContent = option.textContent;
                item.appendChild(textSpan);

                // c) On click, update the hidden select and close
                item.addEventListener('click', () => {
                    originalSelect.value = option.value;
                    button.textContent = option.textContent;
                    dropdown.style.display = 'none';

                    // (Optional) Immediately call changeLocale:
                    changeLocale(option.value);
                });

                dropdown.appendChild(item);
            });

            // 6) Show/hide the dropdown on button click
            button.addEventListener('click', () => {
                dropdown.style.display = (dropdown.style.display === 'none') ? 'block' : 'none';
            });

            // 7) Close the dropdown if user clicks outside
            document.addEventListener('click', (e) => {
                if (!container.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });

            // 8) Insert our custom container after the original select 
            originalSelect.parentNode.insertBefore(container, originalSelect.nextSibling);
        });
    </script>
</body>

</html>
