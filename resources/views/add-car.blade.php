@extends('base')
@section('content')
<div class="mt-5">
    <form class="col-lg-6 offset-lg-3">
        <div class="row justify-content-center">
            <div class="mb-3 mt-5">
                <h4>Автомобиль</h4>
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Владелец</label>
                <select id="disabledSelect" class="form-select">
                    <option>Иванов Иван Иванович</option>
                    <option>Макаров Макар Макарович</option>
                    <option>Иванов Иван Иванович</option>
                    <option>Макаров Макар Макарович</option>
                </select>
            </div>
            <div class="mb-3">
                <a href="/add-client">
                    <button type="button" class="btn btn-secondary">Добавить нового клиента</button>
                </a>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Марка</label>
                <input class="form-control" type="text" placeholder="ВАЗ">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Модель</label>
                <input class="form-control" type="text" placeholder="2107">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Цвет Кузова</label>
                <input class="form-control" type="text" placeholder="Красный">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Гос номер РФ</label>
                <input class="form-control" type="text" placeholder="А000РР134">
            </div>
            <div class="mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Находится на парковке</label>
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </form>
</div>
@endsection
