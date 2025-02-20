@extends('layouts.auth')

@section('title', __('auth.voucher_confirmation'))

@section('content')

    <!-- Title -->
    <h1 class="text-2xl font-bold"> {{ __(translate('voucher_confirmation')) }}</h1>
    <p class="text-gray-400">{{ __(translate('voucher_and_phone_enter')) }}</p>

    <!-- Forma -->
    <form action="{{ route('connect') }}" method="POST" id="voucherForm" class="space-y-4">
        @csrf
        @method('POST')
        <div>
            <label for="phone" class="block text-sm mb-2 text-left">
                {{ __(translate('enter_phone')) }}
            </label>
            <div class="flex items-center bg-gray-700 rounded-lg p-3">
                <span class="text-gray-400 px-2">+998</span>
                <input type="text" id="phone" name="phone" maxlength="12" minlength="12" value="{{$phone}}"
                    class="bg-transparent flex-1 text-white focus:outline-none" placeholder="XX XXX XX XX" required />
            </div>
        </div>

        <!-- Vaucher kod -->
        <div>
            <label for="voucher" class="block text-sm mb-2 text-left">
                {{ __(translate('enter_voucher')) }}
            </label>
            <input type="text" id="voucher" name="voucher"
                class="bg-gray-700 rounded-lg p-3 w-full text-white focus:outline-none"
                placeholder="{{ __(translate('enter_voucher')) }}" required />
        </div>

        <div class="flex justify-between">
            <p class="text-gray-500"> {{ __(translate('you_have_no_voucher')) }}</p>
            <a href="{{ route('getvoucher') }}" id="getVoucher" class="underline cursor-pointer">
                {{ __(translate('get_voucher')) }}</a>
            <p id="timecontent" class="hidden">{{ __('auth.time') }} 00:<span
                    id="timer">{{ site_settings('sms_time') }}</span></p>
        </div>

        <!-- Tasdiqlash tugmasi -->
        <button type="submit" id="verifyBtn"
            class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition">
            {{ __(translate('confirm')) }}
        </button>
        <a href="" id="resentcodeBtn"
            class="w-full block hidden bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition">
            {{ __(translate('resent_code')) }}
        </a>
    </form>

@endsection
