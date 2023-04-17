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
                    <option value="{{ $client->id }}"> {{ $client->name }} </option>
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
    </form>
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
    $("#clientSelect").change( function () {
        var select = document.getElementById("clientSelect");
        $.get('car/by-id-client/' + select.value , function (data){
            $("#carSelect").find('option').remove();
            for(i = 0; i < data.length; i++) {
                $("#carSelect").prepend('<option value="' + data[i]["id"] + '">'+ data[i]["brand"] + " " + data[i]["model"] + " " + data[i]["rf_license_number"] + '</option>');
            }
        })
    });

</script>
@endsection