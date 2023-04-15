@extends('base')
@section('content')
<div class="mt-5">
    <form class="col-lg-6 offset-lg-3">
        <div class="row justify-content-center">
            <div class="mb-3">
                <h4>Добавление клиента на стоянку</h4>
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Клиент</label>
                <select id="disabledSelect" class="form-select">
                    <option>Иванов Иван Иванович</option>
                    <option>Макаров Макар Макарович</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Автомобиль</label>
                <select id="disabledSelect" class="form-select">
                    <option>Лада Калина А233ОЛ134</option>
                    <option>Лада Приора Т123ЛЛ134</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Добавить на стоянку</button>
        </div>
    </form>
</div>
<div class="mt-5">
    <div class="col-lg-6 offset-lg-3">
        @for ($i = 0; $i < 5; $i++)
        <div class="item-container">
            <div class="text-container">
                <div class="text-item"> Иванов Иван Ивановчи</div>
                <div class="text-item"> Лада Калина</div>
                <div class="text-item"> А777УЕ134</div>
            </div>
            <div class="button-delete">
                <button type="button" id="delete-button" class="btn btn-light">Убрать со стоянки</button>
            </div>
        </div>
        @endfor
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
@endsection