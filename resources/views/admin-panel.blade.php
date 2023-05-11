@extends('base')
@section('content')
    <div class="title-container">
        <h2> Список информационных страниц </h2>
    </div>
    <div class="main-container justify-content-center mt-5">
        <div class="col-lg-6 offset-lg-3">
            <div class="d-flex">
                <div class="add_button_container mx-2">
                    <a href="/add-page">
                        <button type="button" id="add-car-button" class="btn btn-primary">Добавить новую страницу</button>
                    </a>
                </div>
            </div>
            <div class="mt-5">
                @foreach ($infoPages as $page)
                    <div class="item-container">
                        <div class="container text-center">
                            <div class="row mt-3">
                                <div class="col-2"> {{ $page->id }} </div>
                                <div class="col-2 size"> {{ $page->title }} </div>
                                <div
                                    class="col-4 size"> {{$page->text }} </div>
                                <div class="col-2">
                                    <a href="/page-update/{{ $page->id }}">
                                        <button type="button" class="btn btn-light">Редактировать</button>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <form action="{{ route('page.delete', $page->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .item-container {
            background-color: #0d6efd;
            color: white;
            height: 70px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.25);
            display: flex;
            position: relative;
            margin: auto;
            margin-top: 10px;

        }

        .title-container {
            text-align: center;
            margin-top: 30px;
        }

        .size {
            white-space: nowrap; /* Отменяем перенос текста */
            overflow: hidden; /* Обрезаем содержимое */
            padding: 5px; /* Поля */
            text-overflow: ellipsis; /* Многоточие */
        }

    </style>
@endpush
