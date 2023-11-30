@extends('layouts.app')

@section("title")
    Профиль
@endsection

@section('content')
    <h1 class="profile-title">Ваши продажи</h1>

    <div>
    @foreach($orders as $order)
        <div class="orders">
        <h1>{{ $order->id }}</h1>
            <a href="{{ route('userOrder', $order) }}">{{$order->name}}</a>
        </div>
    @endforeach
    </div>
@endsection
