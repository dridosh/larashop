@extends('../admin.adminLayouts.adminApp')

@section('title')
   Панель администратора
@endsection

@section('content')
    <div class="col-md-12">
        <h1>Наименование товара: <strong> {{ $product->name }} </strong></h1>

        @isset($product->category)
        <h3>Категория: {{$product->category->name}}</h3>
        @endisset

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
                    <td>{{ $product->id }}</td>
                </tr>
                 <tr>
                    <td>Название</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <td>Цена</td>
                    <td>{{ $product->price }} руб</td>
                </tr>
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{asset('storage/img/products/')}}/{{$product->picture}}"
                             height="240px" alt=""></td>
                </tr>
                <tr>

                </tr>
            </tbody>
        </table>
        <a class="btn btn-success" type="button" href="{{route('adminProduct.index')}}"> Назад </a>

    </div>

@endsection
