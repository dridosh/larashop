@extends('layouts.app')

@section('title')
    {{$title}}
@endsection

@section('content')

<div class="container">

     @if ($showTitle)
        <h1 class="text-center mb-5">{{$title}}</h1>
    @else
        Нет заголовка
    @endif




    <home-component source="blade_template" :categories="{{$categories}}" ></home-component>

</div>
@endsection
