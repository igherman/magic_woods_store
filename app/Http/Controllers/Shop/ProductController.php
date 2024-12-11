<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::where('is_visible', true)->with('media');
        
        if (request('category')) {
            $category = Category::where('slug', request('category'))
                ->where('is_visible', true)
                ->firstOrFail();
            $query->where('category_id', $category->id);
        }

        $products = $query->paginate(9);

        $categories = Category::where('is_visible', true)->get();

        return view('shop.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        if (!$product->is_visible) {
            abort(404);
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_visible', true)
            ->take(4)
            ->get();

        return view('shop.products.show', compact('product', 'relatedProducts'));
    }
} 