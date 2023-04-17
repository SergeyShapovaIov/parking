@extends('base')
@section('content')
<div class="mt-5">
    <form class="col-lg-6 offset-lg-3" method="post" action="car/create">
        @csrf
        <div class="row justify-content-center">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="mb-3 mt-5">
                <h4>Автомобиль</h4>
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Владелец</label>
                <select name="client_id" id="disabledSelect" class="form-select">

                    @foreach ($clients as $client)
                    <option value="{{ $client->id }}"> {{ $client->name }} </option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3">
                <a href="/add-client">
                    <button type="button" class="btn btn-secondary">Добавить нового клиента</button>
                </a>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Марка</label>
                <input name="brand" class="form-control" type="text" placeholder="ВАЗ">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Модель</label>
                <input name="model" class="form-control" type="text" placeholder="2107">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Цвет Кузова</label>
                <input name="color_bodywork" class="form-control" type="text" placeholder="Красный">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Гос номер РФ</label>
                <input name="rf_license_number" class="form-control" type="text" placeholder="А000РР134">
            </div>
            <div class="mb-3">
                <input name="status" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Находится на парковке</label>
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </form>
</div>
@endsection