<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_visible', true)
            ->with('media')
            ->take(8)
            ->get();
            
        $categories = Category::where('is_visible', true)
            ->whereNull('parent_id')
            ->get();

        return view('shop.home', compact('featuredProducts', 'categories'));
    }
} 