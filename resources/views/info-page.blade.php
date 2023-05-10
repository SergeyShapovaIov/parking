@extends('base')
@section('content')
    <div class="main-container justify-content-center mt-5">
        <div class="col-lg-6 offset-lg-3">
            <h2>{{ $page->title }}</h2>

            <div class="content-container">
                {{$page->text}}
            </div>
        </div>
    </div>

    <style>
        .content-container {
            margin-top: 50px;
        }
    </style>
@endsection
