@extends('vendor.biblioteca.layouts.biblioteca')

@section('title')
    Библиотека
@endsection
@section('content')
    <p><a class="btn btn-link" href="{{route('home')}}">Главная > </a> Библиотека</p>
    <h1>Библиотека</h1>
    <a title="добавить новую книгу" class="btn btn-secondary" href="{{route('biblioteca.create')}}"><i class="fas fa-plus-square fa-1x"></i></a>
    <table id="biblioteca-table" class="table table-striped table-light">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Автор</th>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
            <th scope="col">Файл - посмотреть</th>
            <th scope="col">Файл - скачать</th>
            <th scope="col"><i class="fas fa-cogs"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($arr as $lib)
            <tr>
                <th scope="row">{{$lib->id}}</th>
                <td>{{$lib->author}}</td>
                <td>{{$lib->name??'--'}}</td>
                <td>{{$lib->descripton??'--'}}</td>
                <td><a href="{{count($lib->attached_file)>0?route('biblioteca.getfile_view',$lib->attached_file[0]->id):"#"}}" {!!count($lib->attached_file)===0?'class="disabled btn btn-disabled"':'class="btn btn-link"'!!} title="скачать файл"><i class="far fa-file-pdf"></i></a></td>
                <td><a href="{{count($lib->attached_file)>0?route('biblioteca.getfile_download',$lib->attached_file[0]->id):"#"}}" {!!count($lib->attached_file)===0?'class="disabled btn btn-disabled"':'class="btn btn-link"'!!} title="скачать файл"><i class="fas fa-download"></i></a></td>
                <td><a href="{{route('biblioteca.show',[$lib->id])}}" title="редактировать"><i class="far fa-edit"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
{{-- //TODO: change Controller + add views + test + publicsh in packagisn + add git submodule --}}
@section('scripts')
    <script>
        (function () {
            window.addEventListener('load', function () {
                $("#biblioteca-table").DataTable();
            });
        })();
    </script>
@endsection
