<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();
        
        // Get cart items with their products
        $cartItems = $cart->items()->with('product')->get();
        
        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
        // Fixed shipping cost for now - could be made dynamic later
        $shipping = 16;
        
        $total = $subtotal + $shipping;
        
        // Get related products (random products for now)
        $relatedProducts = Product::inRandomOrder()
            ->limit(4)
            ->get();
        
        return view('shop.cart.index', compact(
            'cartItems',
            'subtotal',
            'shipping',
            'total',
            'relatedProducts'
        ));
    }

    protected function getOrCreateCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);
        }

        $sessionId = session()->getId();
        return Cart::firstOrCreate([
            'session_id' => $sessionId,
        ]);
    }

    public function add(Product $product)
    {
        $cart = $this->getOrCreateCart();
        
        $cart->items()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity' => \DB::raw('quantity + 1')]
        );

        return back()->with('success', 'Product added to cart');
    }

    public function remove(Product $product)
    {
        $cart = $this->getOrCreateCart();
        
        $cart->items()->where('product_id', $product->id)->delete();

        return back()->with('success', 'Product removed from cart');
    }

    public function incrementQuantity($itemId)
    {
        $cart = $this->getOrCreateCart();
        
        $cart->items()->where('id', $itemId)->increment('quantity');
        
        return back()->with('success', 'Quantity updated');
    }

    public function decrementQuantity($itemId)
    {
        $cart = $this->getOrCreateCart();
        
        $cartItem = $cart->items()->where('id', $itemId)->first();
        
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } else {
            $cartItem->delete();
        }
        
        return back()->with('success', 'Quantity updated');
    }

    public function removeItem($itemId)
    {
        $cart = $this->getOrCreateCart();
        
        $cart->items()->where('id', $itemId)->delete();
        
        return back()->with('success', 'Item removed from cart');
    }
} 