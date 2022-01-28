@extends('layouts.app')

@section('title')
    {{$title}}
@endsection

@section('content')

<div class="container">
    @auth
        Вы это читаете, потому что вы авторизованы
    @endauth

    @guest
        Пожалуйста, авторизуйтесь
    @endguest

    @if ($showTitle)
        <h1>{{$title}}</h1>
    @else
        Нет заголовка
    @endif

    <home-component source="blade_template" :categories="{{$categories}}" ></home-component>

</div>
@endsection
