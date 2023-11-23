@extends("layouts.app")

@section("title")
    Добавление категории
@endsection

@section('content')
    <h1 class="mb-4">Добавить категорию</h1>
    <div class="container">
        <form method="post" action="{{ route('saveCategory') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-top: 10px">
                <input type="text" class="form-control" name="title" placeholder="название категории"
                       required minlength="3" maxlength="35" value="{{ old('title') ?? '' }}">
            </div>

            <div class="form-group">
                <select id="category_id" name="category_id">
                    <option value="{{null}}">Ничего</option>
                    @foreach($categories as $item)
                        <option value="{{$item->id}}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
