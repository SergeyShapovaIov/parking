@extends('base')
@section('content')
<div class="mt-5">
    <form class="col-lg-6 offset-lg-3" method="post" action="car/update-status/add">
        @csrf
        <div class="row justify-content-center">
            <div class="mb-3">
                <h4>Добавление клиента на стоянку</h4>
            </div>
            <div class="mb-3">
                <label for="clientSelect" class="form-label">Клиент</label>
                <select name="client" id="clientSelect" class="form-select">
                    @foreach ($clients as $client)
                    <option value="{{ $client->id }}"> {{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="carSelect" class="form-label">Автомобиль</label>
                <select name="car_id" id="carSelect" class="form-select">

                </select>
            </div>
            <button type="submit" class="btn btn-primary">Добавить на стоянку</button>
        </div>


        <div class="btn-group mx-2 mt-5">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Сортировать по
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?sort=owner_name&page= {{ $pageNumber }}"> Владелец </a></li>
                <li><a class="dropdown-item" href="?sort=rf_license_number&page= {{ $pageNumber }}"> Гос номер РФ </a></li>
                <li><a class="dropdown-item" href="?sort=model&page= {{ $pageNumber }}"> Модель </a></li>
                <li><a class="dropdown-item" href="?sort=brand&page= {{ $pageNumber }}"> Марка </a></li>
            </ul>
        </div>

</div>
<div class="mt-5">
    <div class="col-lg-6 offset-lg-3">
        @foreach ($cars as $car)
        <div class="item-container">
            <div class="text-container">
                <div class="text-item">{{ $car->owner_name }}</div>
                <div class="text-item"> {{ $car->brand }}</div>
                <div class="text-item">{{ $car->rf_license_number }}</div>
            </div>
            <div class="button-delete">
                <form action="car/update-status/delete" method="post">
                    @csrf
                    <input type="hidden" class="" value="{{ $car->id }}" name="car_id">
                    <button type="submit" id="delete-button" class="btn btn-light">Убрать со стоянки</button>
                </form>
            </div>
        </div>
        @endforeach
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

    .list-container {
        margin-top: 50px;
        width: 70%;
        margin: auto;
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

    #delete-button {
        width: 200px;
    }

    .button-delete {
        margin-top: 15px;
        margin-right: 20px;
    }
</style>

<script>
    function changeDataInSelect() {
        var select = document.getElementById("clientSelect");
        $.get('car/by-id-client/' + select.value, function (data) {
            $("#carSelect").find('option').remove();
            for (i = 0; i < data.length; i++) {
                $("#carSelect").prepend('<option value="' + data[i]["id"] + '">' + data[i]["brand"] + " " + data[i]["model"] + " " + data[i]["rf_license_number"] + '</option>');
            }
        })
    }

    changeDataInSelect();

    $("#clientSelect").change(function () {
        changeDataInSelect();
    });

</script>
@endsection
