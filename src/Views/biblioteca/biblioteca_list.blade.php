@extends('vendor.biblioteca.layouts.module')

@section('title')
   Библиотека
@endsection
@section('content')
    <p><a class="btn btn-link" href="{{route('home')}}">Главная:</a> Словарик: <span class="btn btn-link"
                                                                                     id="btn_add_dic"
                                                                                     title="добавить новый термин"><i
                class="far fa-plus-square"></i></span><span title="режим обзора" class="btn btn-link text-success"
                                                            id="btn_view_slides"><i
                class="fab fa-sticker-mule"></i></span> <span id="dic_spinner" class="d-inline"><i
                class="fas fa-cog fa-spin text-primary"></i></span></p>
@endsection
{{-- //TODO: change Controller + add views + test + publicsh in packagisn + add git submodule --}}
