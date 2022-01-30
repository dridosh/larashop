@extends('../admin.adminLayouts.adminApp')

@section('title')
    Панель администратора
@endsection

@section('content')
    <div class="col-md-12 gy-5">

        @isset($category)
            <h1>Редактировать категорию: <b>{{ $category->name }}</b></h1>
        @else
            <h1>Добавить Категорию</h1>
        @endisset
        <br>
        <form method="POST" enctype="multipart/form-data"
              @isset($category)
              action="{{ route('adminCategories.update', $category) }}"
              @else
              action="{{ route('adminCategories.store') }}"
            @endisset
        >
            <div>
                @isset($category)
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
                               value="@isset($category){{ $category->name }}@endisset">
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
                                  rows="7">@isset($category){{ $category->description }}@endisset</textarea>
                    </div>
                </div>
                <br>

                    <div class="mb-3">
                        <label class="form-label">
                            Изображение
                        </label>
                        <br>
                        @isset($category)
                        <img
                            style="height:240px;margin-bottom: 30px ;border: 1px solid grey;"
                            src="{{asset('storage/img/categories/')}}/{{$category->picture}}"
                        >
                        @endisset
                        <input class="form-control mb-5" name="picture" type="file">
                    </div>



                <a class="btn btn-success" type="button" href="{{route('adminCategories.index')}}"> Назад </a>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>

    </div>

@endsection
