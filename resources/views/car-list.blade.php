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
        <div class="mt-5">
            @foreach ($cars as $car)
            <div class="item-container">
                <div class="container text-center">
                    <div class="row mt-3">
                        <div class="col-2"> {{ $car->brand }} </div>
                        <div class="col-2"> {{ $car->rf_license_number }} </div>
                        <div class="col-4"> {{ $car->owner_name }} </div>
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
                        <li class="page-item @if($pageNumber == 1) disabled @endif"><a class="page-link" href="/client-list?page={{$pageNumber-1}}">Previous</a></li>
                        @if($pageCount < 9)
                            @for($i = 1; $i <= $pageCount; $i++)
                            <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link" href="/client-list?page= {{ $i }}">{{ $i }}</a></li>
                            @endfor
                        @else

                            @if($pageNumber <= 9 )
                                @for($i = 1; $i <=10; $i++)
                                    <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link" href="/client-list?page= {{ $i }}">{{ $i }}</a></li>
                                @endfor
                            @endif

                            @if($pageNumber > 9 && $pageNumber <= $pageCount-9)
                                <li class="page-item @if($pageNumber == 1) active @endif"><a class="page-link" href="/client-list?page= {{ 1 }}">{{ 1 }}</a></li>
                                <li class="page-item"><a class="page-link" href="#"> ... </a></li>
                                <li class="page-item"><a class="page-link" href="/client-list?page= {{ $pageNumber - 2 }}">{{ $pageNumber - 2 }}</a></li>
                                <li class="page-item"><a class="page-link" href="/client-list?page= {{ $pageNumber - 1 }}">{{ $pageNumber - 1 }}</a></li>
                                <li class="page-item active"><a class="page-link" href="/client-list?page= {{ $pageNumber }}">{{ $pageNumber }}</a></li>
                                <li class="page-item "><a class="page-link" href="/client-list?page= {{ $pageNumber + 1 }}">{{ $pageNumber + 1 }}</a></li>
                                <li class="page-item"><a class="page-link" href="/client-list?page= {{ $pageNumber + 2 }}">{{ $pageNumber + 2 }}</a></li>
                                <li class="page-item"><a class="page-link" href="#"> ... </a></li>
                                <li class="page-item @if($pageNumber == $pageCount) active @endif"><a class="page-link" href="/client-list?page= {{ $pageCount }}">{{ $pageCount }}</a></li>
                            @endif

                            @if($pageNumber > 9 && $pageNumber > $pageCount -9)
                            @for($i = $pageCount-9; $i <= $pageCount; $i++)
                                    <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link" href="/client-list?page= {{ $i }}">{{ $i }}</a></li>
                                @endfor
                            @endif
                        @endif
                        
                        <li class="page-item @if($pageNumber == $pageCount) disabled @endif"><a class="page-link" href="/client-list?page={{$pageNumber+1}}">Next</a></li>
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

    .text-item {
        padding: 0 20px 0 20px;
    }

    .icon-item {
        padding: 0 10px 0 10px;
    }

    .list-container {
        margin-top: 50px;
        width: 70%;
        margin: auto;
    }

    .icon-container {
        width: 20%;
        display: flex;
        float: right;
        margin: 15px 0 15px 300px;
    }

    .text-container {
        display: flex;
        width: 80%;
        float: left;
        margin: 25px 0 25px 60px;
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
