@extends('../admin.adminLayouts.adminApp')

@section('title')
   Панель администратора
@endsection

@section('content')

    @if (session('startExportCategories'))
        <div class="alert alert-success">
            Выгрузка категорий запущена
        </div>
    @endif


    <div class="container">
        <form method="post" action="{{ route('exportCategories') }}">
            @csrf
            <button type="submit" class="btn btn-link
">Выгрузить категории</button>
        </form>

        <h3 class="text-center mb-5">Категории</h3>


        <table class="table">
            <tbody>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Изображение
                    </th>
                     <th>
                        Название
                    </th>
                    <th>
                        Описание
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td> <img src="{{asset('storage/img/categories/')}}/{{$category->picture}}"
                                  height="40px"> </td>

                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{route('adminCategories.destroy', $category)}}" method="POST">
                                    <a class="btn btn-success" type="button" href="{{route('adminCategories.show', $category)}}">Открыть</a>
                                    <a class="btn btn-warning" type="button" href="{{route('adminCategories.edit', $category)}}">Редактировать</a>
                                    @csrf
                                   @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Удалить"></form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a class="btn btn-success" type="button"
           href="{{route ('adminCategories.create')}}">Добавить категорию</a>



    </div>

@endsection
