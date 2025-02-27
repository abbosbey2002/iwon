@extends('layouts.dashboard')

@section('title', 'Policy')

@section('content')

<div>
    <form class="form-group" action="{{ route('admin.policy.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Policy Title:</label>
        <input class="outline-none border border-gray-300 p-2 rounded" type="text" name="title" value="{{ old('title', $policy->title ?? '') }}"><br/>  
        <label for="editor1">Policy Content:</label>
        <textarea name="editor1">{{ old('editor1', $policy->content ?? '') }}</textarea><br/> 
        
        <button class="btn btn-primary">Save</button>
    </form>
</div>

<!-- Include CKEditor -->
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>  

<script>  
    document.addEventListener("DOMContentLoaded", function () {
        CKEDITOR.replace('editor1');
    });
</script>  

@endsection
