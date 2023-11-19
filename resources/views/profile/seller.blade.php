@extends('layouts.app')

@section("title")
    Ваши продажи
@endsection

@section('content')
    <h1>Ваши продажи</h1>

    <div>
    @foreach($orders as $order)
        <div class="orders">
        <h1>{{ $order->id }}</h1>
            <a href="{{ route('userOrder', $order) }}">{{$order->name}}</a>
        </div>
    @endforeach
    </div>
@endsection
