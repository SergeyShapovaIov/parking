@extends('base')

@section('content')
    <div class="mt-5">
        @if(isset($message))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/meta-tag/" method="post" class="col-lg-6 offset-lg-3">
            @csrf
            <div id= "form" class="row justify-content-center">
                <div class="justify-content-center">
                    <h3>Метатег</h3>
                    <input name="page_id" type="hidden" value={{ $pageId }}>
                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input name="name" class="form-control" type="text" placeholder="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Содержание</label>
                        <input name="content" class="form-control" type="text" placeholder="new title">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
@endsection
