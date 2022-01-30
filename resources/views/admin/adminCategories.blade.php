@extends('../admin.adminLayouts.adminApp')

@section('title')
   Панель администратора
@endsection

@section('content')
    <div class="container">
        <h3 class="text-center m-5">Категории</h3>
        <table class="table">
            <tbody>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Код
                    </th>
                    <th>
                        Название
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->code }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="" method="POST">
                                    <a class="btn btn-success" type="button" href="">Открыть</a>
                                    <a class="btn btn-warning" type="button" href="">Редактировать</a>
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
           href="">Добавить категорию</a>
    </div>

@endsection
