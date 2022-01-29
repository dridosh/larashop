@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center m-5">{{ $category->name }}</h2>
        <div class="row">
            <category-component :category-id="{{$category->id}}"></category-component>
        </div>
    </div>
@endsection
