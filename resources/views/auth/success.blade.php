@extends('layouts.auth')

@section('title', 'Success')

@section('content')

<div class="flex">
    <!-- Success Card -->
    <div class="rounded-lg shadow-lg text-center">
        <img class="w-30 md:w-40 mx-auto mb-4" src="{{ asset('images/success.webp') }}" alt="Success">
    </div>
</div>

@endsection

