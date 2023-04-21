@extends('base')
@section('content')
<form class="col-lg-6 offset-lg-3" method="post" action="/car/updateOwner">
    @csrf
    <div class="row justify-content-center">
        <div class="mb-3">
            <label for="disabledSelect2" class="form-label"> Определить владельца автомобиля </label>
            <select name="client_id" id="disabledSelect2" class="form-select" value="">
                @foreach ($clients as $client)
                <option value="{{ $client->id }}"> {{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="car_id" value=" {{ $car->id }} ">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>

<form class="col-lg-6 offset-lg-3" method="post" action="/car/update">
    @csrf
    <div class="row justify-content-center">
        <div class="mb-3 mt-5">
            <h4>Автомобиль</h4>
        </div>
        <div class="mb-3">
            <label class="form-label">Марка</label>
            <input name="brand" class="form-control" type="text" placeholder="ВАЗ" value="{{ $car->brand }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Модель</label>
            <input name="model" class="form-control" type="text" placeholder="2107" value="{{ $car->model }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Цвет Кузова</label>
            <input name="color_bodywork" class="form-control" type="text" placeholder="Красный"
                   value="{{ $car->color_bodywork }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Гос номер РФ</label>
            <input name="rf_license_number" class="form-control" type="text" placeholder="А000РР134"
                   value=" {{ $car->rf_license_number}}">
            <input type="hidden" name="car_id" value="{{ $car-> id}}">
        </div>
        <div class="mb-3">
            <input class="form-check-input" type="checkbox" name="status" role="switch" id="flexSwitchCheckDefault"
                   value="yes" @if ($car->status == 1) checked @endif>
            <label class="form-check-label" for="flexSwitchCheckDefault">Находится на парковке</label>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>

@endsection