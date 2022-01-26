@extends('layouts.app')

@section('content')
    <div class="container">
        <h3> ID категории: {{ $category->id }} </h3>
        <h3> Название категории: {{ $category->name }} </h3>

        <div class="row">
            <category-component :category-id="{{$category->id}}"></category-component>
        </div>
    </div>
@endsection