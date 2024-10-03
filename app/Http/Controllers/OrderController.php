<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        // Преобразуем поле products из JSON в массив
        foreach ($orders as $order) {
            $order->products = json_decode($order->products, true);
        }

        $totalOrdersPrice = $orders->sum('total_price');

        return view('orders.index', compact('orders', 'totalOrdersPrice'));
    }

    // Удаление заказа
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Заказ успешно удалён.');
    }
}
