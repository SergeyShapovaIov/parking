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
            @for ($i = 0; $i < 5; $i++)
            <div class="item-container">
                <div class="container text-center">
                    <div class="row mt-3">
                        <div class="col-4"> Иванов Иван Иванович</div>
                        <div class="col-3"> 89234781234</div>
                        <div class="col-3">
                            <a href="/client-update/{{$i}}">
                                <button type="button" class="btn btn-light">Редактировать</button>
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="/">
                                <button type="button" class="btn btn-light">Удалить</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="pagination-container">
            <div class="pagination-wrapper">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

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