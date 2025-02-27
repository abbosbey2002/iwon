@extends('layouts.auth')

@section('title', __('app.mobile_app'))

@section('content')

    <!-- Title -->
    <h1 class="text-2xl font-bold">{{__(translate('mobile_app'))}}</h1>
    <p class="text-gray-400">{{__(translate('download_app'))}}</p>

    <!-- App Download Buttons -->
    <div class="flex justify-center space-x-4">
        <!-- Google Play -->    
        <a href="{{site_settings('google_play_link ')}}" target="_blank" class="">
            <img src="{{site_settings('google_play_image')}}" alt="Google Play" class="">
                {{-- <span>{{ __('Google Play') }}</span> --}}
        </a>

        <!-- App Store -->
        <a href="{{site_settings('app_store_link')}}" target="_blank" class="">
            <img src="{{site_settings('app_store_image')}}" alt="App Store" class="">
                {{-- <span>{{ __('App Store orqali yuklab olish') }}</span> --}}
        </a>
    </div>

    <!-- Divider -->
    <div class="border-t border-gray-700 my-4"></div>

    <!-- Keyingi Bosqichga O'tish -->
    <div>
        <p class="text-gray-400 mb-4">{{__(translate('already_have'))}}</p>
        <a href="{{route('getvoucher')}}" id="nextStepButton" class="w-full block bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold">
            {{__(translate('get_voucher'))}}
        </a>

        <a href="{{route('checkVacherPage')}}" id="nextStepButton" class="w-full flex items-center space-x-3 gap-2 justify-center bg-purple-600 hover:bg-purple-700 mt-3 text-white py-3 rounded-lg font-semibold">
            {{__(translate('use_voucher_btn'))}} <img width="20" src="{{asset('images/wfsets.webp')}}" alt="" />
        </a>
    </div>
@endsection
