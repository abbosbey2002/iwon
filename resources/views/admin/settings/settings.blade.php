@extends('layouts.dashboard')

@section('title', __('auth.voucher_confirmation'))

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <div class="container-fixed">

        <div class="grid mx-auto">
            <div class="card pb-2.5">
                <div class="card-header" id="basic_settings">
                    <h3 class="card-title">
                        General Settings
                    </h3>
                </div>
                <form action="{{ isset($setting) ? route('settings.update', $setting->id) : route('settings.store') }}" 
                    method="POST" 
                    enctype="multipart/form-data" 
                    class="card-body grid gap-5">
                  @csrf
              
                  @if(isset($setting))
                      @method('PUT')
                  @endif                
                    {{-- <x-form.input label="{{__('Site logo')}}" type="file" name="site_logo"
                        value="{{$setting?->site_logo}}" /> --}}

                    <x-form.image label="{{ __('Site logo') }}" name="site_logo" value="{{ $setting?->site_logo }}" />



                    <x-form.image label="{{__('Customer logo')}}" type="text" name="customer_logo"
                        value="{{$setting?->customer_logo}}" />

                    <x-form.input label="{{__('Google play link')}}" type="text" name="google_play_link"
                        value="{{$setting?->google_play_link}}" />
                    
                    <x-form.input label="{{__('App store link')}}" type="text" name="app_store_link"
                        value="{{$setting?->app_store_link}}" />

                    <x-form.image label="{{__('Google play image')}}" type="text" name="google_play_image"
                        value="{{$setting?->google_play_image}}" />
                    
                    <x-form.image label="{{__('App store image')}}" type="text" name="app_store_image"
                        value="{{$setting?->app_store_image}}" />


                    <x-form.input label="{{__('Expired date')}}" type="number" name="expired_date"
                        value="{{$setting?->expired_date}}" />

                        
                    <div class="flex justify-end">
                        <button class="btn btn-primary">
                            Save Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
