@extends('layouts.app')

@section("title")
    Ваши продажи
@endsection

@section('content')
    <h1>Ваши продажи</h1>

    @if (count($products))
        <table class="table table-bordered" style="color: #ffffff">
            <tr>
                <th>№</th>
                <th width="22%">Детали</th>
                <th width="22%">Название</th>
                <th width="22%">Цена</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('product', $product) }}">
                            Подробнее
                        </a>
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->price }}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
