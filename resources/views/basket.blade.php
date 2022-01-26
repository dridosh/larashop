@extends('layouts.app')

@section('content')
    <div class="container">

        <basket-component
            :products="{{$products}}"
            route-login="{{route('login')}}"
            route-home="{{route('home')}}"
            :error-list="{{$errors}}"
        >
        </basket-component>
    </div>

@endsection