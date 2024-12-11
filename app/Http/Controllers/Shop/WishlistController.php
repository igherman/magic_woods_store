<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = $this->getOrCreateWishlist();
        return view('shop.wishlist', compact('wishlist'));
    }

    public function add(Product $product)
    {
        $wishlist = $this->getOrCreateWishlist();
        
        $wishlist->items()->firstOrCreate([
            'product_id' => $product->id
        ]);

        return back()->with('success', 'Product added to wishlist');
    }

    public function remove(Product $product)
    {
        $wishlist = $this->getOrCreateWishlist();
        
        $wishlist->items()->where('product_id', $product->id)->delete();

        return back()->with('success', 'Product removed from wishlist');
    }

    protected function getOrCreateWishlist()
    {
        if (Auth::check()) {
            return Wishlist::firstOrCreate([
                'user_id' => Auth::id(),
            ]);
        }

        $sessionId = session()->getId();
        return Wishlist::firstOrCreate([
            'session_id' => $sessionId,
        ]);
    }
} 