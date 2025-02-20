<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'iWon Mobil Ilovasi')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <link href="{{ asset('assets/media/app/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180" />
    <link href="{{ asset('assets/media/app/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png" />
    <link href="{{ asset('assets/media/app/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png" />
    <link href="{{ asset('assets/media/app/favicon.ico') }}" rel="shortcut icon" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
</head>

<body
    class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] [--tw-page-bg-dark:var(--tw-coal-500)] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]">
    <!-- Theme Mode -->
    <script>
        const defaultThemeMode = 'light'; // light|dark|system
        let themeMode;

        if (document.documentElement) {
            if (localStorage.getItem('theme')) {
                themeMode = localStorage.getItem('theme');
            } else if (document.documentElement.hasAttribute('data-theme-mode')) {
                themeMode = document.documentElement.getAttribute('data-theme-mode');
            } else {
                themeMode = defaultThemeMode;
            }

            if (themeMode === 'system') {
                themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }

            document.documentElement.classList.add(themeMode);
        }
    </script>
    <!-- End of Theme Mode -->
    <!-- Page -->
    <!-- Main -->
    <div class="flex grow">
        @include('partials/sidebar')
        <!-- Wrapper -->
        <div class="wrapper flex grow flex-col">
            <!-- Header -->
            @include('partials/header')
            <!-- End of Header -->
            <!-- Content -->
            <main class="grow content pt-5" id="content" role="content">
                <!-- Container -->
                <div class="container-fixed" id="content_container">
                </div>
                <!-- End of Container -->

                <!-- Container -->
                <div class="container px-5">

                    @yield('content')

                </div>
                <!-- End of Container -->
            </main>
            <!-- End of Content -->
            <!-- Footer -->
            {{-- @include('partials/footer') --}}
            <!-- End of Footer -->
        </div>
        <!-- End of Wrapper -->
    </div>
    <!-- End of Main -->

    <!-- End of Page -->
    <!-- Scripts -->
    <script src="{{ asset('assets/js/core.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/widgets/general.js') }}"></script>
    <script src="{{ asset('assets/js/layouts/demo1.js') }}"></script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const addLanguageBtn = document.getElementById('add-language-btn')
                document.getElementById('add-language-btn').click()
                if (addLanguageBtn) {
                    addLanguageBtn.click();
                    console.log(document.getElementById('add-language-btn') + 'working');
                }
            })
        </script>
    @endif
    <!-- End of Scripts -->
</body>

</html>
