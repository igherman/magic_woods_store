@extends('layouts.shop')

@section('title', 'Finalizare comandă')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-semibold mb-8">Finalizare comandă</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2">
            <!-- Personal Details -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-lg font-medium">Datele mele</h2>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                </div>
                <div class="text-gray-700">
                    <p class="font-medium">{{ $order['first_name'] }} {{ $order['last_name'] }}</p>
                    <p class="text-gray-600">{{ $order['email'] }}</p>
                </div>
            </div>

            <!-- Billing Address -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-lg font-medium">Adresa de facturare</h2>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                </div>
                <div class="text-gray-700">
                    <p class="font-medium">{{ $order['first_name'] }} {{ $order['last_name'] }}</p>
                    <p>{{ $order['billing_address.address'] ?? '' }}</p>
                    <p>{{ $order['billing_address.city'] ?? '' }}</p>
                    <p>{{ $order['billing_address.postal_code'] ?? '' }}</p>
                    <p>Romania</p>
                </div>
            </div>

            <!-- Shipping Details -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-lg font-medium">Livrare</h2>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                </div>
                <div class="text-gray-700">
                    <p>Livrare la domiciliu</p>
                    <p class="font-medium mt-2">{{ $order['first_name'] }} {{ $order['last_name'] }}</p>
                    <p>{{ $order['phone_prefix'] ?? '+40' }} {{ $order['phone'] }}</p>
                    <p>{{ $order['shipping_address.address'] ?? $order['billing_address.address'] ?? '' }}</p>
                    <p>{{ $order['shipping_address.city'] ?? $order['billing_address.city'] ?? '' }}</p>
                    <p>{{ $order['shipping_address.postal_code'] ?? $order['billing_address.postal_code'] ?? '' }}</p>
                    <p>Romania</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-medium mb-4">Reduceri</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Valoare comandă</span>
                        <span class="font-medium">{{ number_format($subtotal, 2) }} Lei</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Livrare</span>
                        <span class="font-medium">{{ number_format($shipping, 2) }} Lei</span>
                    </div>
                    <div class="border-t pt-4">
                        <div class="flex justify-between">
                            <span class="font-medium">Total</span>
                            <span class="font-medium">{{ number_format($total, 2) }} Lei</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('checkout.confirm') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="mt-6 w-full inline-flex justify-center items-center px-6 py-3 border border-transparent 
                                   text-base font-medium rounded-md text-black bg-primary-600 hover:bg-primary-700">
                        Finalizare cumpărături
                    </button>
                </form>

                <p class="mt-4 text-sm text-gray-600">
                    Dacă decizi să continui, ești de acord cu 
                    <a href="#" class="text-primary-600 hover:text-primary-500">Termenii și condițiile</a>.
                </p>
                <p class="mt-2 text-sm text-gray-600">
                    Îți vom procesa datele personale în conformitate cu 
                    <a href="#" class="text-primary-600 hover:text-primary-500">Politica de Confidențialitate</a>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection 