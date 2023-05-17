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

        <form class="col-lg-6 offset-lg-3" method="post" action="/page/create">
            @csrf
            <div class="row justify-content-center">
                <div class="mb-3">
                    <h4>Страница</h4>
                </div>
                <div class="mb-3">
                    <label class="form-label">Заголовок</label>
                    <input name="title" class="form-control" type="text" placeholder="Сотрудники"
                    value="@if(isset($title)) {{ $title }}@else{{ old('title') }}@endif">
                </div>

                <div class="mb-3">
                    <label class="form-label">Текст</label>
                    <textarea id="myeditorinstance" name="text" style="height: 500px" class="form-control" type="text" placeholder="Иван : Программист">@if(isset($text)) {{ $text }}@else{{ old('text') }}@endif</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ссылка</label>
                    <input name="link" class="form-control" type="text" placeholder="employees" value="@if(isset($link)) {{ $link }}@else{{ old('link') }}@endif">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

@push('tiny-script')
    <script src="https://cdn.tiny.cloud/1/xpncnbyav65dci2wtb1t1ncmvny0ak9m3exych86k5v3ax96/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
@endpush
