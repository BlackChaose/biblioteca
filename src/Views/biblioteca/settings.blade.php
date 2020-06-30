@extends('vendor.biblioteca.layouts.biblioteca')
@section('title')
    Библиотека > настройки
@endsection
@section('content')
    @if($form_type==="show")
        <p><a class="btn btn-link" href="{{route('home')}}">Главная ></a><a class="btn btn-link"
                                                                            href="{{route('biblioteca.list')}}">Библиотека
                ></a> книга: "{{$book->name}}"</p>
        <h1>{{$book->name}}</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">автор</th>
                <th scope="col">название книги</th>
                <th scope="col">описание</th>
                <th scope="col">файл</th>
            </tr>
            </thead>
            <tbody>
            <tr scope="row">
                <td>{{$book->id}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->name}}</td>
                <td>{{$book->description??'--'}}</td>
                <td><a href="{{(count($book->attached_file)>0)?url($book->attached_file[0]->file_path):"#"}}"><i class="far fa-file-pdf"></i></a></td>
            </tr>
            </tbody>
        </table>
        <hr>
        <a class="btn btn-warning" href="{{route('biblioteca.edit',$book->id)}}">Редактировать</a>

        {{ Form::model($book, ['url' => route('biblioteca.destroy',[$book->id]),'method'=>'DELETE', 'class'=>'needs-validation', 'validate'=>'validate','files'=>false]) }}
        @csrf
        <div class="form-group">
            {{ Form::submit('Удалить',['class'=>'btn btn-danger']) }}
        </div>
        {{ Form::close() }}
    @endif

    @if($form_type === 'create')
        {{ Form::model($biblioteca, ['url' => route('biblioteca.store'),'method'=>'POST', 'class'=>'needs-validation', 'validate'=>'validate','files'=>true]) }}
        @csrf
        @include('vendor.biblioteca.form')
        <div class="form-group">
            {{ Form::submit('Создать',['class'=>'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
    @endif

    @if($form_type === 'edit')
        {{ Form::model($biblioteca, ['url' => route('biblioteca.update',[$biblioteca, $biblioteca->id]),'method'=>'PUT', 'class'=>'needs-validation', 'validate'=>'validate','files'=>true]) }}
        @csrf
        @include('vendor.biblioteca.form')
        <div class="form-group">
            {{ Form::submit('Сохранить',['class'=>'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
    @endif

    @if($form_type === 'operation_result')
        @include('vendor.biblioteca.message')
    @endif

@endsection

@section('scripts')
    @if($form_type==='edit')
        <script>
            (function () {
                window.addEventListener('load', function () {
                    let del_file = document.getElementById('delete_attached_book');
                    del_file.addEventListener('click', function (e) {
                        let attached_book = document.getElementById('attached_book');
                        let input_ab = document.getElementById('input_ab');
                        let input_ab_warning = document.getElementById('input_ab_warning');
                        attached_book.style.textDecoration = 'line-through';
                        attached_book.style.border="1px solid orange";
                        input_ab_warning.className="text-info small d-inline";
                        if (input_ab.value == "TRUE") {
                            input_ab.value = "FALSE";
                            attached_book.style.textDecoration = 'none';
                            attached_book.style.border="none";
                            input_ab_warning.className="text-info small d-none";
                        } else {
                            input_ab.value = "TRUE";
                        }
                    });
                });
            })();
        </script>
    @endif
@endsection
