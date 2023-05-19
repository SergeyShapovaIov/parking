@extends('base')
@section('content')
    <div class="mt-5">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="col-lg-6 offset-lg-3" method="post" action="/page/update">
            @csrf
            <div class="row justify-content-center">
                <div class="mb-3">
                    <h4>Страница</h4>
                </div>
                <div class="mb-3">
                    <label class="form-label">Заголовок</label>
                    <input name="title" class="form-control" type="text"
                           value="{{ $page->title }}">
                    <input type="hidden" name="page_id" value="{{ $page->id }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Текст</label>
                    <textarea style="height: 500px" id="myeditorinstance" contenteditable name="text"
                              class="form-control" type="text">{{ $page->text }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ссылка</label>
                    <input name="link" class="form-control" type="text" placeholder="Волгоград, ул.Советская, 34"
                           value="{{ $page->link}}">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>

        </form>
        <div class="col-lg-6 offset-lg-3 mt-5">
            <div class="justify-content-center">
                <div class="mb-3">
                    <h4>Список метатегов</h4>
                </div>
            </div>
            <div class="mb-3">
                <a href="/add-meta-tag/{{ $pageId }}">
                    <button type="button" id="add-meta-tag-group" class="btn btn-info mb-3">Добавить метатег</button>
                </a>
            </div>

            @for($i = 0; $i < count($tags); $i++)
                <h3>Метатег @if($i > 0)
                        {{ $i+1 }}
                    @endif</h3>
                <div class="mb-3">
                    <p>Название: {{  $tags[$i]->name }}</p>
                    <p>Содержание: {{  $tags[$i]->content }}</p>
                </div>
                <form action="{{ route('meta-tag.delete-by-id', [$pageId, $tags[$i]->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-3">Удалить</button>
                </form>
            @endfor

        </div>
    </div>
@endsection
@push('tiny-script')
    <script src="https://cdn.tiny.cloud/1/xpncnbyav65dci2wtb1t1ncmvny0ak9m3exych86k5v3ax96/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
@endpush

