@extends("layouts.app")

@section("title")
    Добавление товара
@endsection

@section('content')
    <div class="container">
        <h1 class="mb-4">Добавить продукт</h1>
        <form method="post" action="{{ route('saveProduct') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-top: 10px">
                <input type="text" class="form-control" name="title" placeholder="Название товара"
                       required minlength="3" maxlength="35" value="{{ old('title') ?? '' }}">
            </div>

            <div class="form-group" style="margin-top: 10px">
                <input type="number" class="form-control" name="price" placeholder="Стоимость"
                       required maxlength="10" value="{{ old('price') ?? '' }}">
            </div>
            <div class="form-group" style="margin-top: 10px">
                <input type="text" class="form-control" name="description" placeholder="Описание"
                       required maxlength="255" value="{{ old('description') ?? '' }}">
            </div>

            <div class="form-group" , style="margin-top: 10px">
                <input type="text" class="form-control" name="article" placeholder="Артикул товара"
                       required maxlength="255" value="{{ old('article') ?? '' }}">
            </div>

            <div class="form-group" style="margin-top: 10px">
                <div>Ваша картинка</div>
                <input style="margin-top: 10px" type="file" class="form-control-file" name="thumbnail" id="thumbnail"
                       multiple accept="image/*,image/jpeg"
                       required maxlength="255">
            </div>

            <div class="form-group" style="margin-top: 10px">
                <div>Файл с тех. документацией</div>
                <input style="margin-top: 10px" type="file" class="form-control-file" name="file" id="file">
            </div>

            <div class="form-group" style="margin-top: 10px">
                <p>Бренд</p>
                <select id="brand_id" name="brand_id">
                    @foreach($brands as $item)
                        <option value="{{$item->id}}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="margin-top: 10px">
                <p>Категория</p>
                <select id="category_id" name="category_id">
                    @foreach($categories as $item)
                        @if($item->parent_id == null)
                            <option value="{{$item->id}}">{{ $item->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="margin-top: 10px">
                <p>Подкатегория</p>
                <select id="subcategory_id" name="subcategory_id">
                    <option value="{{null}}">Отсутствует</option>
                    @foreach($categories as $item)
                        @if($item->parent_id != null)
                            <option value="{{$item->id}}">{{ $item->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
