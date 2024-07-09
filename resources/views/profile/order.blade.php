@extends('layouts.app')

@section("title")
    Заказ
@endsection

@section('content')
    <div class="order">
    <h1>Детали заказа</h1>
    <table class="table table-bordered" style="color: #ffffff">
        <tr>
            <th>№</th>
            <th>Наименование</th>
{{--            <th>Цена</th>--}}
        </tr>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
{{--                <td>{{ $item->price }}</td>--}}
            </tr>
        @endforeach
{{--        <tr>--}}
{{--            <th colspan="2" class="finish">Итого</th>--}}
{{--            <th class="finish">{{ $order->amount }}</th>--}}
{{--        </tr>--}}
    </table>

    <h2>Ваши данные</h2>
    <p>Имя, фамилия: {{ $order->name }}</p>
    <p>Адрес почты: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>Номер телефона: {{ $order->phone }}</p>
    <p>Адрес доставки: {{ $order->address }}</p>
    @isset ($order->comment)
        <p>Комментарий: {{ $order->comment }}</p>
    @endisset
    </div>
@endsection
