@extends("layouts.app")

@section("title")
    Редактирование категории
@endsection

@section('content')
    <h1 class="mb-4">Редактировать категорию</h1>
    <div class="container">
        <form method="post" action="{{ route('editCategorySubmit', $category->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-top: 10px">
                <input type="text" class="form-control" name="title" placeholder="название категории"
                       required minlength="3" maxlength="22" value="{{ $category->title }}">
            </div>

            <div class="form-group">
                <p>Категория-родитель</p>
                <select id="parent_id" name="parent_id">
                    <option value="{{ $category->parent_id }}">Прежнее</option>
                    <option value="{{ null }}">Отсутствует</option>
                    @foreach($categories as $item)
                        @if($item->parent_id == null and $category->parent_id != $item->id)
                        <option value="{{$item->id}}">{{ $item->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
