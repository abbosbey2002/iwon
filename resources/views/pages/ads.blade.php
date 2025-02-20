<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'iWon Mobil Ilovasi')</title>
    <!-- Tailwind + your compiled app CSS -->
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ site_settings('site_logo') }}" type="image/x-icon" />
    <!-- Alpine.js (Needed only if you use the Alpine approach) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <style>
        body {
            background: url("{{ asset('storage/' . $ads->desktop) }}");
            background-size: cover;
            background-position: center;
        }

        @media only screen and (max-width: 768px) {
            body {
                background: url("{{ asset('storage/' . $ads->mobile) }}");
                background-size: cover;
                background-position: center;
            }
        }
    </style>

    <!-- Advertisement Video -->
    <div class="container">
        <video src="{{ asset('storage/' . $ads->video) }}" autoplay class="w-full"></video>


        <!-- Countdown Loader (initially visible) -->
        <div id="countdown"
            class=" bottom-4  transform bg-gray-800 bg-opacity-75 text-white p-4 rounded-lg shadow-lg flex items-center space-x-2">
            <!-- Spinner Icon -->
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span>Please wait <span id="seconds">10</span> seconds...</span>
        </div>


        <!-- Proceed Button (hidden initially) -->
        <div id="proceed" class="">
            <a href="" class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded shadow">
                Proceed
            </a>
        </div>
    </div>


    <!-- JavaScript for Countdown -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let countdownSeconds = 10; // Set your countdown time in seconds
            const secondsEl = document.getElementById("seconds");
            const countdownEl = document.getElementById("countdown");
            const proceedEl = document.getElementById("proceed");

            const timer = setInterval(() => {
                countdownSeconds--;
                secondsEl.textContent = countdownSeconds;
                if (countdownSeconds <= 0) {
                    clearInterval(timer);
                    // Hide the loader and reveal the proceed button
                    countdownEl.classList.add("hidden");
                    proceedEl.classList.remove("hidden");
                }
            }, 1000);
        });
    </script>
</body>

</html>
