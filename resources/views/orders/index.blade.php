@extends('layouts.app')

@section('title-page', 'Список заказов')

@section('content')
    <h1 class="mb-4">Список заказов</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(count($orders) > 0)
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Номер заказа</th>
                <th>Дата заказа</th>
                <th>Товары</th>
                <th>Общая стоимость заказа</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        @foreach($order->products as $product)
                            {{ $product['name'] }} ({{ $product['quantity'] }} шт.)<br/>
                        @endforeach
                    </td>
                    <td>{{ $order->total_price }} руб.</td>
                    <td>
                        <!-- Форма для удаления заказа -->
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот заказ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="alert alert-info">
            <strong>Итоговая стоимость всех заказов: </strong>{{ $totalOrdersPrice }} руб.
        </div>
    @else
        <div class="alert alert-warning">
            <p>Заказов пока нет.</p>
        </div>
    @endif
@endsection
