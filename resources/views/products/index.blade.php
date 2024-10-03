@extends('layouts.app')

@section('title-page', 'Каталог товаров')

@section('content')
    <h1 class="mb-4">Каталог товаров</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="my-5">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <!-- Карточка товара -->
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Товар 1">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Цена: {{ $product->price }} руб.</small>

                            <!-- Форма для добавления товара в корзину -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center mt-2">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1" class="form-control w-25 me-2">
                                <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
