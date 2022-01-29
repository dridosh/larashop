@extends('../admin.adminLayouts.adminApp')

@section('title')
    Админкаaaa
@endsection

@section('content')
    <div class="container">
        <h3 class="text-center m-5">Пользователи</h3>

        <table class="table table-borderd mb-5">
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

        @if (session('startExportCategories'))
        <div class="alert alert-success">
            Выгрузка категорий запущена
        </div>
        @endif

        <form method="post" action="{{ route('exportCategories') }}">
            @csrf
            <button type="submit" class="btn btn-link">Выгрузить категории</button>
        </form>
    </div>
@endsection
