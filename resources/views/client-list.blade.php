@extends('base')
@section('content')
    <div class="title-container">
        <h2> Все клиенты </h2>
    </div>
    <div class="main-container justify-content-center mt-5">
        <div class="col-lg-6 offset-lg-3">
            <div class="d-flex">
                <div class="add_button_container mx-2">
                    <a href="/add-client">
                        <button type="button" id="add-car-button" class="btn btn-primary">Добавить клиента</button>
                    </a>
                </div>
            </div>
            <div class="mt-5">
                @foreach ($clients as $client)
                    <div class="item-container">
                        <div class="container text-center">
                            <div class="row mt-3">
                                <div class="col-4"> {{ $client->name }}</div>
                                <div class="col-3"> {{ $client->phone_number}}</div>
                                <div class="col-3">
                                    <a href="/client-update/{{ $client->id }}">
                                        <button type="button" class="btn btn-light">Редактировать</button>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <form action="{{ route('client.delete',$client->id) }}" method="post">
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

    @include('pagination')
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

    </style>
@endpush
