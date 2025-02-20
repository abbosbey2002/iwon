<!DOCTYPE html>
<html class="h-full">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .page-bg {
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="antialiased flex h-full">
    <div class="flex items-center justify-center grow page-bg">
        <div class="bg-white rounded-lg shadow-lg max-w-[370px] w-full">
            <form action="{{ route('login') }}" method="POST"
                class="p-8 flex flex-col gap-5 bg-white shadow-lg rounded-lg w-96">
                @csrf

                <!-- Header -->
                <div class="text-center mb-6">
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Sign in</h3>
                </div>

                <!-- Success message -->
                @if (session('success'))
                    <div class="text-green-600 text-sm text-center">{{ session('success') }}</div>
                @endif

                <!-- Errors -->
                @if ($errors->any())
                    <div class="text-red-600 text-sm text-center">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Email Input -->
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input
                        class="px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        type="email" name="email" placeholder="email@example.com" value="{{ old('email') }}"
                        required />
                </div>

                <!-- Password Input -->
                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-gray-700">Password</label>
                    </div>
                    <div class="relative">
                        <input
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            type="password" name="password" placeholder="Enter password" required />
                    </div>
                </div>

                <!-- Remember Me -->
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                    <span class="text-sm text-gray-600">Remember me</span>
                </label>

                <!-- Submit Button -->
                <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>

</html>
