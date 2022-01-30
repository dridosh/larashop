@extends('../admin.adminLayouts.adminApp')

@section('title')
    Панель администратора
@endsection

@section('content')
    <div class="col-md-12 gy-5">

        @isset($product)
            <h1>Редактировать товар: <b>{{ $product->name }}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset
        <br>
        <form method="POST" enctype="multipart/form-data"
              @isset($product)
              action="{{ route('adminProduct.update', $product) }}"
              @else
              action="{{ route('adminProduct.store') }}"
            @endisset
        >
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        {{--                        @error('name')--}}
                        {{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
                        {{--                        @enderror--}}
                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($product){{ $product->name }}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        {{--                        @error('description')--}}
                        {{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
                        {{--                        @enderror--}}
                        <textarea name="description" id="description" cols="72"
                                  rows="7">@isset($product){{ $product->description }}@endisset</textarea>
                    </div>
                </div>


                    <div class="input-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                        <div class="col-sm-6">
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            @isset($product)
                                            @if($product->category_id == $category->id)
                                            selected
                                        @endif
                                        @endisset
                                    >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <br>
                    <div class="input-group row">
                        <label for="description" class="col-sm-2 col-form-label">Цена: </label>
                        <div class="col-sm-6">
                            {{--                        @error('description')--}}
                            {{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
                            {{--                        @enderror--}}
                            <input type="text" class="form-control" name="price" id="price"
                                   value="@isset($product){{ $product->price }}@endisset">
                        </div>
                    </div>

                <br>

                    <div class="mb-3">
                        <label class="form-label">
                            Изображение
                        </label>
                        <br>
                        @isset($product)
                        <img
                            style="height:240px;margin-bottom: 30px ;border: 1px solid grey;"
                            src="{{asset('storage/img/products/')}}/{{$product->picture}}"
                        >
                        @endisset
                        <input class="form-control mb-5" name="picture" type="file">
                    </div>



                <a class="btn btn-success" type="button" href="{{route('adminProduct.index')}}"> Назад </a>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>

    </div>

@endsection
