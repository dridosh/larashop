@extends('layouts.app')


@section('title')
    Личный кабинет
@endsection

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('profileUpdated'))
            <div class="alert alert-success text-center">
                Профиль успешно обновлен!
            </div>
        @endif

        @if (session()->has('currentPasswordError'))
            <div class="alert alert-warning text-center">
                Вы ввели неверный текущий пароль
            </div>
        @endif

        <form method="POST" action="{{ route('profileUpdate') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">
                    Почта
                </label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}">
                <div id="emailHelp" class="form-text">
                    We'll never share your email with anyone else.
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">
                    Имя
                </label>
                <input
                class="form-control @if ($errors->has('name')) text-danger @endif" 
                name="name"
                value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">
                    Текущий пароль
                </label>
                <input
                autocomplete="new-password"
                class="form-control" 
                name="current_password"
                type="password"
                >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">
                    Новый пароль
                </label>
                <input
                class="form-control" 
                name="password"
                type="password"
                >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">
                    Повторите пароль
                </label>
                <input
                class="form-control" 
                name="password_confirmation"
                type="password"
                >
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Изображение
                </label>
                <br>
                <img
                    style="height:100px;margin-bottom: 10px;border-radius: 100px;border: 2px solid grey;"
                    src="{{asset('storage/img/users/')}}/{{$user->picture}}"
                >
                <input class="form-control" name="picture" type="file">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Список адресов
                </label>
                <br>
                @foreach ($user->addresses as $address)
                    <span>
                        @if ($address->main)
                            <label for="{{$address->id}}">
                                {{$address->address}}
                            </label>
                            <input checked id="{{$address->id}}" type="radio" name="main_address" value="{{$address->id}}">
                        @else
                            <label for="{{$address->id}}">
                                {{$address->address}}
                            </label>
                            <input  id="{{$address->id}}" type="radio" name="main_address" value="{{$address->id}}">
                        @endif
                    </span>
                    <br>
                @endforeach
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Новый адрес
                </label>
                <input name="new_address" class="form-control">
                <label>Сделать основным</label>
                <input type="checkbox" name="main_new_address">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection