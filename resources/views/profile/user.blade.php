@extends('layouts.app')

@section("title")
    Профиль
@endsection

@section('content')
    <h1 class="profile-title">Ваши заказы</h1>

    @if (count($orders))
        <table class="table table-bordered" style="color: #ffffff">
            <tr>
                <th>№</th>
                <th width="22%">Детали</th>
                <th width="22%">Имя, Фамилия</th>
                <th width="22%">Адрес почты</th>
                <th width="22%">Номер телефона</th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('userOrder', $order) }}">
                            Подробнее
                        </a>
                    </td>
                    <td>{{ $order->name }}</td>
                    <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                    <td>{{ $order->phone }}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
