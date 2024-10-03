@extends('layouts.app')

@section('title-page', 'Корзина')

@section('content')
    <h1 class="mb-4">Корзина</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($cart)
        <div class="my-5">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($cart as $id => $details)
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Товар 1">
                            <div class="card-body">
                                <h5 class="card-title">{{ $details['name'] }}</h5>
                                <p class="card-text">Количество в корзине: {{ $details['quantity'] }}</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Цена: {{ $details['price'] }} руб.</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <h3 class="my-3">Общая сумма: <span class="fw-bold">{{ $totalPrice }} руб.</span></h3>

        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-lg">Оформить заказ</button>
        </form>
    @else
        <p>Ваша корзина пуста.</p>
    @endif
@endsection
