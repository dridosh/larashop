@extends('../admin.adminLayouts.adminApp')

@section('title')
   Панель администратора
@endsection

@section('content')
    <div class="col-md-12">
        <h1>Категория {{ $category->name }}</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th>
                        Поле
                    </th>
                    <th>
                        Значение
                    </th>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>{{ $category->id }}</td>
                </tr>
                 <tr>
                    <td>Название</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{asset('storage/img/categories/')}}/{{$category->picture}}"
                             height="240px" alt=""></td>
                </tr>
                <tr>
                    <td>Кол-во товаров</td>
                    <td>{{ $category->products->count() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
