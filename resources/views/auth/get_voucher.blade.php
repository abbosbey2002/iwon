@extends('layouts.auth')

@section('title', 'Get voucher')

@section('content')

    <!-- Title -->
    <h1 class="text-2xl font-bold"> {{ __(translate('voucher_confirmation')) }}</h1>
    <p class="text-gray-400">{{ __(translate('voucher_and_phone_enter')) }}</p>

    <!-- Forma -->
    <form action="{{ route('checkVacherPage') }}" method="POST" id="voucherForm" class="space-y-4">
        @csrf
        <div>
            <label for="phone" class="block text-sm mb-2 text-left">
                {{ __(translate('enter_phone')) }}
            </label>
            <div class="flex items-center bg-gray-700 rounded-lg p-3">
                <span class="text-gray-400 px-2">+998</span>
                <input type="text" id="phone" name="phone" maxlength="12" minlength="12"
                    class="bg-transparent flex-1 text-white focus:outline-none" placeholder="XX XXX XX XX" required />
            </div>
            @error('phone')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            @if (session('phone_error'))
            <p class="text-red-500 text-sm">{{ session('phone_error') }}</p>
            @endif
        </div>

        <div class="flex flex-col space-y-2 text-gray-500">
            <div class="flex items-center space-x-3">
                <input id="acceptTerms" class="checkbox" name="acceptTerms" type="checkbox"
                    class="border-gray-300 rounded shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                              {{ $errors->has('acceptTerms') ? 'border-red-500' : '' }}"
                    value="1" {{ old('acceptTerms') ? 'checked' : '' }}>
                <label for="acceptTerms" class="text-gray-700 cursor-pointer">
                    Accept Privacy Policy & Terms
                </label>
            </div>

            @error('acceptTerms')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>


        <!-- Tasdiqlash tugmasi -->
        <button type="submit" id="verifyBtn"
            class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition">
            {{ __(translate('confirm')) }}
        </button>
    </form>

@endsection
