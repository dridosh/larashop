@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center m-5">Корзина</h2>

        <basket-component
            :products="{{$products}}"
            route-login="{{route('login')}}"
            route-home="{{route('home')}}"
            route-orders="{{route('orders')}}"
            :error-list="{{$errors}}"
            name="{{$name}}"
            email="{{$email}}"
            main-address="{{$mainAddress->address ?? ''}}"
        >
        </basket-component>
    </div>

@endsection
