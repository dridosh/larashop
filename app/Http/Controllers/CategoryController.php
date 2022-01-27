<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function category (Category $category)
    {

        return view('category', compact('category'));
    }

    public function getProducts (Category $category)
    {
        $products = $category->products;
        $basketProducts = session('products');
        return $products->transform(function ($product) use ($basketProducts) {
            $product->quantity = $basketProducts[$product->id] ?? 0;
            return $product;
        });
    }
}
