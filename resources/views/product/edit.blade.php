@extends("layouts.app")

@section("title")
    Редактирование товара
@endsection

@section('content')
    <div class="container">
        <h1 class="mb-4">Редактировать продукт</h1>
        <form method="post" action="{{ route('editProductSubmit', $product->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-top: 10px">
                <input type="text" class="form-control" name="title" placeholder="Название товара"
                       required minlength="3" maxlength="35" value="{{ $product->title }}">
            </div>
            <div class="form-group" style="margin-top: 10px">
                <input type="number" class="form-control" name="price" placeholder="Стоимость"
                       required maxlength="10" value="{{ $product->price }}">
            </div>
            <div class="form-group" style="margin-top: 10px">
                <input type="text" class="form-control" name="description" placeholder="Описание"
                       required maxlength="255" value="{{ $product->description }}">
            </div>
            <div class="form-group" style="margin-top: 10px">
                <div>Ваша картинка</div>
                <input style="margin-top: 10px" type="file" class="form-control-file" name="image" id="image" multiple accept="image/*,image/jpeg"
                       maxlength="255" value="{{ old('image') ?? '' }}">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
