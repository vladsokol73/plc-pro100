@extends("layouts.app")

@section("title")
    Редактирование брэнда
@endsection

@section('content')
    <div class="container">
        <h1 class="mb-4">Редактировать брэнд</h1>
        <form method="post" action="{{ route('editBrandSubmit', $brand->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-top: 10px">
                <input type="text" class="form-control" name="title" placeholder="Название товара"
                       required minlength="3" maxlength="35" value="{{ $brand->title }}">
            </div>
            <div class="form-group" style="margin-top: 10px">
                <div>Новая картинка</div>
                <input style="margin-top: 10px" type="file" class="form-control-file" name="image" id="image" multiple accept="image/*,image/jpeg"
                       maxlength="255" value="{{ old('image') ?? '' }}">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
