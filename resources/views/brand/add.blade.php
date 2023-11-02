@extends("layouts.app")

@section("title")
    Добавление брэнда
@endsection

@section('content')
    <h1 class="mb-4">Добавить брэнд</h1>
    <div class="container">
        <form method="post" action="{{ route('saveBrand') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-top: 10px">
                <input type="text" class="form-control" name="title" placeholder="имя брэнда"
                       required minlength="3" maxlength="35" value="{{ old('title') ?? '' }}">
            </div>
            <div class="form-group" style="margin-top: 10px">
                <div>Ваша картинка</div>
                <input style="margin-top: 10px" type="file" class="form-control-file" name="thumbnail" id="thumbnail" multiple accept="image/*,image/jpeg"
                        maxlength="255" value="{{ old('thumbnail') ?? '' }}">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
