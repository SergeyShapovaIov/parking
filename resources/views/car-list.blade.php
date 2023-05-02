@extends('base')
@section('content')
<div class="title-container">
    <h2> Список автомобилей </h2>
</div>
<div class="main-container justify-content-center mt-5">
    <div class="col-lg-6 offset-lg-3">
        <div class="d-flex">
            <div class="add_button_container mx-2">
                <a href="/add-car">
                    <button type="button" id="add-car-button" class="btn btn-primary">Добавить автомобиль</button>
                </a>
            </div>
        </div>

        <div class="btn-group mx-2 mt-3">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Сортировать по
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?sort=brand&page= {{ $pageNumber }}"> Марка </a></li>
                <li><a class="dropdown-item" href="?sort=model&page= {{ $pageNumber }}"> Модель </a></li>
                <li><a class="dropdown-item" href="?sort=color_bodywork&page= {{ $pageNumber }}"> Цвет кузова</a></li>
                <li><a class="dropdown-item" href="?sort=rf_license_number&page= {{ $pageNumber }}"> Гос номер РФ</a></li>
                <li><a class="dropdown-item" href="?sort=status&page= {{ $pageNumber }}"> Нахождение на парковке</a></li>
            </ul>
        </div>

        <div class="mt-5">
            @foreach ($cars as $car)
            <div class="item-container">
                <div class="container text-center">
                    <div class="row mt-3">
                        <div class="col-2"> {{ $car->brand }} </div>
                        <div class="col-2"> {{ $car->rf_license_number }} </div>
                        <div class="col-4"> {{ $owner = $car->owner_name == NULL ? 'Нет владельца' : $car->owner_name }} </div>
                        <div class="col-2">
                            <a href="/car-update/{{ $car->id }}">
                                <button type="button" class="btn btn-light">Редактировать</button>
                            </a>
                        </div>
                        <div class="col-2">
                            <form action="{{ route('car.delete', $car->id) }}" method="post">
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
        @if($pageCount > 1)
        <div class="pagination-container justify-content-center d-flex">
            <div class="pagination-wrapper">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item @if($pageNumber == 1) disabled @endif"><a class="page-link" href="/cart-list?page={{$pageNumber-1}}&sort= {{ $sort }}">Previous</a></li>
                        @if($pageCount < 9)
                            @for($i = 1; $i <= $pageCount; $i++)
                            <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link" href="/car-list?page= {{ $i }}&sort= {{ $sort }}">{{ $i }}</a></li>
                            @endfor
                        @else

                            @if($pageNumber <= 9 )
                                @for($i = 1; $i <=10; $i++)
                                    <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link" href="/car-list?page= {{ $i }} &sort= {{ $sort }}">{{ $i }}</a></li>
                                @endfor
                            @endif

                            @if($pageNumber > 9 && $pageNumber <= $pageCount-9)
                                <li class="page-item @if($pageNumber == 1) active @endif"><a class="page-link" href="/car-list?page= {{ 1 }}">{{ 1 }}</a></li>
                                <li class="page-item"><a class="page-link" href="#"> ... </a></li>
                                <li class="page-item"><a class="page-link" href="/car-list?page= {{ $pageNumber - 2 }}&sort= {{ $sort }}">{{ $pageNumber - 2 }}</a></li>
                                <li class="page-item"><a class="page-link" href="/car-list?page= {{ $pageNumber - 1 }}&sort= {{ $sort }}">{{ $pageNumber - 1 }}</a></li>
                                <li class="page-item active"><a class="page-link" href="/car-list?page= {{ $pageNumber }}&sort= {{ $sort }}">{{ $pageNumber }}</a></li>
                                <li class="page-item "><a class="page-link" href="/car-list?page= {{ $pageNumber + 1 }}&sort= {{ $sort }}">{{ $pageNumber + 1 }}</a></li>
                                <li class="page-item"><a class="page-link" href="/car-list?page= {{ $pageNumber + 2 }}&sort= {{ $sort }}">{{ $pageNumber + 2 }}</a></li>
                                <li class="page-item"><a class="page-link" href="#"> ... </a></li>
                                <li class="page-item @if($pageNumber == $pageCount) active @endif"><a class="page-link" href="/car-list?page= {{ $pageCount }}&sort= {{ $sort }}">{{ $pageCount }}</a></li>
                            @endif

                            @if($pageNumber > 9 && $pageNumber > $pageCount -9)
                            @for($i = $pageCount-9; $i <= $pageCount; $i++)
                                    <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link" href="/car-list?page= {{ $i }}&sort= {{ $sort }}">{{ $i }}</a></li>
                                @endfor
                            @endif
                        @endif

                        <li class="page-item @if($pageNumber == $pageCount) disabled @endif"><a class="page-link" href="/car-list?page={{$pageNumber+1}}&sort= {{ $sort }}">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        @endif

</div>
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

    .pagination-container {
        margin-top: 40px;
        width: 100%
    }

    .pagination-wrapper {
        width: 300px;
        margin: auto;
    }

</style>
@endsection
