@extends('../admin.adminLayouts.adminApp')

@section('title')
   Панель администратора
@endsection

@section('content')
    @if (session('startExportProducts'))
        <div class="alert alert-success">
            Выгрузка товаров запущена
        </div>
    @endif


    <div class="container">
        <form method="post" action="{{ route('exportProducts') }}">
            @csrf
            <button type="submit" class="btn btn-link
">Выгрузить товары</button>
        </form>



        <div class="container">
        <h3 class="text-center m-5">Товары</h3>
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
                        Наименование
                    </th>
                     <th>
                        Цена, руб
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td> <img src="{{asset('storage/img/products/')}}/{{$product->picture}}"
                                  height="40px"> </td>

                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price}}</td>
                        <td>
                            <div class="btn-group" role="group"  >
                                <form action="{{route('adminProduct.destroy', $product)}}" method="POST">
                                    <a class="btn btn-success" type="button" href="{{route('adminProduct.show', $product)}}">Открыть</a>
                                    <a class="btn btn-warning" type="button" href="{{route('adminProduct.edit', $product)}}">Редактировать</a>
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Удалить"></form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$products->links("pagination::bootstrap-4")}}

        <a class="btn btn-success" type="button"
           href="{{route ('adminProduct.create')}}">Добавить товар</a>
    </div>
@endsection
