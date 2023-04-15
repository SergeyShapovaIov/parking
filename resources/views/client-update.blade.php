@extends('base')
@section('content')
    <div class="mt-5">
        
        <form class="col-lg-6 offset-lg-3">
        <div class="row justify-content-center">
            <div class="mb-3">
                <h4>Клиент</h4>
            </div>
            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">ФИО</label>
                    <input class="form-control" type="text" placeholder="Иванов Иван Иванович">
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Пол</label>
                <select id="disabledSelect" class="form-select">
                    <option>Мужчина</option>
                    <option>Женщина</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Телефон</label>
                <input class="form-control" type="text" placeholder="89942345678">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Адресс</label>
                <input class="form-control" type="text" placeholder="Волгоград, ул.Советская, 34">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        </form>
    </div>

    <div class="mt-5">
        <form class="col-lg-6 offset-lg-3">

            @for ($i = 0; $i < 3; $i++)
            <div class="row justify-content-center">
                <div class="mb-3 mt-5">
                    <h4>Автомобиль {{ $i+1 }}</h4>
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
    
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            @endfor
        </form>
    </div>

@endsection