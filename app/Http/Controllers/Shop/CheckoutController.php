<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();

        $cartItems = $cart->items()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $shipping = 16;
        $total = $subtotal + $shipping;

        return view('shop.checkout.index', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'billing_address' => 'required|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_postal_code' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:20',
        ]);

        // Store order details in session for confirmation page
        session(['order_details' => $validated]);

        return redirect()->route('checkout.confirmation');
    }

    public function confirmation()
    {
        $cart = $this->getCart();

        $cartItems = $cart->items()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $shipping = 16;
        $total = $subtotal + $shipping;

        // Get the order details from the session if they exist
        $order = session('order_details', [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'phone_prefix' => '+40',
            'phone' => '',
            'billing_address' => '',
            'billing_city' => '',
            'billing_postal_code' => '',
            'shipping_address' => '',
            'shipping_city' => '',
            'shipping_postal_code' => '',
        ]);

        return view('shop.checkout.confirmation', compact(
            'cartItems',
            'subtotal',
            'shipping',
            'total',
            'order'
        ));
    }

    public function confirm()
    {
        $orderDetails = session('order_details');
        $cart = $this->getCart();

        if (!$orderDetails || !$cart) {
            return redirect()->route('checkout')
                ->with('error', 'A apărut o eroare. Vă rugăm să încercați din nou.');
        }

        //1 is anonymous user
        $userId = auth()->id() ?? config('constants.anonymous_user_id');

        // Calculate totals
        $subtotal = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        $shipping = 16;
        $total = $subtotal + $shipping;

        // Build billing and shipping addresses
        $billingAddress = [
            'street' => $orderDetails['billing_address'],
            'city' => $orderDetails['billing_city'],
            'postal_code' => $orderDetails['billing_postal_code'],
            'country' => 'Romania'
        ];

        $shippingAddress = [
            'street' => $orderDetails['shipping_address'] ?? $orderDetails['billing_address'],
            'city' => $orderDetails['shipping_city'] ?? $orderDetails['billing_city'],
            'postal_code' => $orderDetails['shipping_postal_code'] ?? $orderDetails['billing_postal_code'],
            'country' => 'Romania'
        ];

        // Create the order
        $order = Order::create([
            'user_id' => $userId,
            'number' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'pending',
            'payment_status' => 'not_payed',
            'first_name' => $orderDetails['first_name'],
            'last_name' => $orderDetails['last_name'],
            'email' => $orderDetails['email'],
            'phone' => $orderDetails['phone'],
            'billing_address' => $billingAddress,
            'shipping_address' => $shippingAddress,
            'shipping_price' => $shipping,
            'total_price' => $total,
        ]);

        // Add order items
        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'order_id' => $order->id,
                'quantity' => $item->quantity,
                'unit_price' => $item->product->price,
            ]);
        }

        // Clear cart and session
        $cart->delete();
        session()->forget('order_details');

        return redirect()->route('checkout.success', $order)
            ->with('success', 'Comanda dvs. a fost plasată cu succes!');
    }

    protected function getCart()
    {
        return auth()->check()
            ? \App\Models\Cart::firstOrCreate(['user_id' => auth()->id()])
            : \App\Models\Cart::firstOrCreate(['session_id' => session()->getId()]);
    }

    public function success(Order $order)
    {
        // Verify the order belongs to the current user or is an anonymous order
        if ($order->user_id !== (auth()->id() ?? config('constants.anonymous_user_id'))) {
            abort(403);
        }

        return view('shop.checkout.success', [
            'order' => $order
        ]);
    }
}