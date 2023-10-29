@extends('layouts.app')

@section("title")
    Ваш заказ
@endsection

@section('content')
    <h1>Заказ размещен</h1>

    <p>Ваш заказ успешно размещен.</p>

    <h2>Ваш заказ</h2>
    <table class="table table-bordered" style="color: #0bcebf">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Цена</th>
        </tr>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->price }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="2" class="text-right">Итого</th>
            <th>{{ $order->amount }}</th>
        </tr>
    </table>

    <h2>Ваши данные</h2>
    <p>Имя, фамилия: {{ $order->name }}</p>
    <p>Адрес почты: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>Номер телефона: {{ $order->phone }}</p>
    <p>Адрес доставки: {{ $order->address }}</p>
    @isset ($order->comment)
        <p>Комментарий: {{ $order->comment }}</p>
    @endisset
@endsection
