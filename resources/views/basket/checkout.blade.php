@extends("layouts.app")

@section("title")
    Оформление заказа
@endsection

@section('content')
    <form method="post" class="checkout" action="{{ route('saveOrder') }}">
        <h1 class="mb-4">Оформить заказ</h1>
        @csrf
        <div class="form-group">
            <i class="fa fa-user icon"></i>
            <input type="text" class="form-control" name="name" placeholder="Имя"
                   required maxlength="255" value="{{ old('name') ?? '' }}">
        </div>
        <div class="form-group">
            <i class="fa fa-envelope"></i>
            <input type="email" class="form-control" name="email" placeholder="Почта"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group">
            <i class="fa-solid fa-phone"></i>
            <input type="number" class="form-control" name="phone" placeholder="Телефон"
                   required maxlength="255" value="{{ old('phone') ?? '' }}">
        </div>
        <div class="form-group">
            <i class="fa-solid fa-location-dot"></i>
            <input type="text" class="form-control" name="address" placeholder="Адрес доставки"
                   required maxlength="255" value="{{ old('address') ?? '' }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="comment" placeholder="Комментарий"
                      maxlength="255">{{ old('comment') ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn checkout-submit">Оформить</button>
        </div>
    </form>
@endsection
