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
          <button type="submit" class="btn btn-primary">Отправить</button>
       </div>
    </form>
   </div>

@endsection

<style>
 .for
</style>
