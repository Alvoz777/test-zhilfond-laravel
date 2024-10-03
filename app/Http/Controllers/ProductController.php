<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Получаем все товары из базы данных
        $products = Product::all();

        return view('products.index', compact('products'));
    }
}
