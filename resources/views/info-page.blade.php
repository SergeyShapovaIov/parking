@extends('base')

@section('meta_tags')
    @foreach($tags as $tag)
        <meta name="{{ $tag->name }}}" content="{{ $tag->content }}">
    @endforeach
@endsection

@section('content')
    <div class="main-container justify-content-center mt-5">
        <div class="col-lg-6 offset-lg-3">
            <h2>{{ $page->title }}</h2>
            <div class="content-container">
                {!! $page->text !!}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .content-container {
            margin-top: 50px;
        }
    </style>
@endpush
