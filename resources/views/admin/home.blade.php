@extends('../layouts.app')

@section('title')
    Админка
@endsection

@section('content')
    <div class="container">
<<<<<<< HEAD
        <table class="table table-borderd">
=======
        <table class="table table-borderd mb-5">
>>>>>>> laravel
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{ route('enterAsUser', $user->id) }}">
                                Войти
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
<<<<<<< HEAD
=======

        @if (session('startExportCategories'))
        <div class="alert alert-success">
            Выгрузка категорий запущена
        </div>
        @endif

        <form method="post" action="{{ route('exportCategories') }}">
            @csrf
            <button type="submit" class="btn btn-link">Выгрузить категории</button>
        </form>
>>>>>>> laravel
    </div>
@endsection