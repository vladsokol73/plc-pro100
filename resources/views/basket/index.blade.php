@extends("layouts.app")

@section("title")
    Корзина
@endsection

@section('content')
    @if (count($products))
        <h1>Ваша корзина</h1>
        @php
            $basketCost = 0;
        @endphp
        <table class="table table-bordered" style="color: #0bcebf">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Цена</th>
            </tr>
            @foreach($products as $product)
                @php
                    $itemPrice = $product->price;
                    $basketCost = $basketCost + $itemPrice;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('product', $product) }}">{{ $product->title }}</a>
                    </td>
                    <td>{{ $itemPrice }}</td>
                    <td>
                        <form action="{{ route('basketRemove', ['id' => $product->id]) }}"
                              method="post" class="form-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Удалить</button>
                        </form></td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2" class="text-right">Итого</th>
                <th>{{ $basketCost }}</th>
            </tr>
        </table>
        <a href="{{ route('checkout') }}">Оформить заказ</a>
    @else
        <p>Ваша корзина пуста</p>
    @endif
@endsection
