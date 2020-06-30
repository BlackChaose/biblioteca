@extends('vendor.biblioteca.layouts.biblioteca')
@section('title')
    Библиотека > результат операции
@endsection
@section('content')
    @if($result_code === "ok")
    <div class="alert alert-success">
        Ok! Success! <b>{{$res}}</b>
    </div>
    @elseif($result_code === "error")
    <div class="alert alert-danger">
        Error! <b>{{$res}}</b>
    </div>
    @else
    <div class="alert alert-info">
        Unknown situation!
    </div>
    @endif
    <a class="btn btn-primary" href="{{url(route('biblioteca.list'))}}">к списку книг <i class="fas fa-map-signs"></i></a>
@endsection
