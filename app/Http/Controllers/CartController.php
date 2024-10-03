<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        // Получаем товар по ID
        $product = Product::find($id);

        // Получаем текущую корзину из сессии или создаем новую
        $cart = session()->get('cart', []);

        // Проверяем, есть ли товар уже в корзине
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            // Добавляем товар в корзину
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity
            ];
        }

        // Сохраняем корзину в сессии
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    // Показать товары в корзине
    public function showCart()
    {
        $cart = session()->get('cart');
        $totalPrice = 0;

        // Если корзина не пуста, вычисляем общую сумму
        if ($cart) {
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }

        return view('cart.index', compact('cart', 'totalPrice'));
    }

    // Оформить заказ
    public function checkout()
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста!');
        }

        $totalPrice = 0;
        $products = [];

        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $products[] = [
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ];
        }

        Order::create([
            'products' => json_encode($products),
            'total_price' => $totalPrice,
        ]);

        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Заказ успешно оформлен! Общая сумма: ' . $totalPrice);
    }

}
