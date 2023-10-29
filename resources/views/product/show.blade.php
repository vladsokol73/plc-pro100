@extends("layouts.app")

@section("title", $product->title)

@section("content")
    @auth()
        <div class="row">
            <div class="col-12">
                <div class="card-header">
                    <h1>{{ $product->title }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ $product->image }}"
                                 alt="" class="img-fluid">
                        </div>
                        <div class="col-md-2">
                            <p>Цена: {{ $product->price }} ₽</p>

                            @if(auth()->user()->role == "покупатель")
                                <form action="{{ route('basketAdd', ['id' => $product->id]) }}"
                                      method="post" class="form-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Добавить в корзину</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            Описание:
                            <p class="mt-4 mb-0">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            Продавец:
                            {{ $seller }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    @guest()
        <div class="row">
            <div class="col-12">
                <div class="card-header">
                    <h1>{{ $product->title }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ $product->image }}"
                                 alt="" class="img-fluid">
                        </div>
                        <div class="col-md-2">
                            <p>Цена: {{ $product->price }} ₽</p>

                            <form action="{{ route('login') }}"
                                  method="post" class="form-inline">
                                @csrf
                                <button
                                    onclick="window.location.href = '{{ route("login") }}'"
                                    type="button"
                                    class="btn btn-outline-light me-2">
                                    Добавить в корзину
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="mt-4 mb-0">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection
