@extends('layouts.app')
@section('content')
<div class="mt-5">
    <form class="col-lg-6 offset-lg-3" method="post" action="/client/update">
        @csrf
        <div class="row justify-content-center">
            <div class="mb-3">
                <h4>Клиент</h4>
            </div>
            <div class="mb-3">
                <label class="form-label">ФИО</label>
                <input name="name" class="form-control" type="text" placeholder="Иванов Иван Иванович"
                       value="{{ $client->name }}">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Пол</label>
                <select name="gender" id="disabledSelect" class="form-select" value=" {{ $client->gender }}">
                    <option>Мужчина</option>
                    <option>Женщина</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Телефон</label>
                <input name="phone_number" class="form-control" type="text" placeholder="89942345678"
                       value="{{ $client->phone_number }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Адрес</label>
                <input name="address" class="form-control" type="text" placeholder="Волгоград, ул.Советская, 34"
                       value="{{ $client->address}}">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>

<div class="mt-5">

    @for ($i = 0; $i < count($cars); $i++)
    <form class="col-lg-6 offset-lg-3" method="post" action="/car/update">
        @csrf
        <div class="row justify-content-center">
            <div class="mb-3 mt-5">
                <h4>Автомобиль {{ $i+1 }}</h4>
            </div>
            <div class="mb-3">
                <label class="form-label">Марка</label>
                <input name="brand" class="form-control" type="text" placeholder="ВАЗ" value="{{ $cars[$i]->brand }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Модель</label>
                <input name="model" class="form-control" type="text" placeholder="2107" value="{{ $cars[$i]->model }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Цвет Кузова</label>
                <input name="color_bodywork" class="form-control" type="text" placeholder="Красный"
                       value="{{ $cars[$i]->color_bodywork}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Гос номер РФ</label>
                <input name="rf_license_number" class="form-control" type="text" placeholder="А000РР134"
                       value=" {{ $cars[$i]->rf_license_number}}">
                <input type="hidden" name="car_id" value="{{ $cars[$i]-> id}}">
            </div>
            <div class="mb-3">
                <input class="form-check-input" type="checkbox" name="status" role="switch" id="flexSwitchCheckDefault"
                       value="yes" @if ($cars[$i]->status == 1) checked @endif>
                <label class="form-check-label" for="flexSwitchCheckDefault">Находится на парковке</label>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
    @endfor
</div>

@endsection
