@extends('layouts.shop')

@section('title', 'Produse')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-semibold mb-8">Coșul meu de cumpărătri</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 space-y-6">
                @forelse ($cartItems as $item)
                    <div class="flex items-center space-x-4 py-4 border-b border-gray-200 last:border-0">
                        <div class="flex-shrink-0 w-24 h-24">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                class="w-full h-full object-cover rounded-lg">
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-medium">{{ $item->product->name }}</h3>
                            <p class="text-gray-600">{{ $item->product->price }} Lei</p>
                        </div>

                        <div class="flex items-center space-x-3">
                            <form action="{{ route('cart.decrement', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-gray-700">
                                    <span class="text-xl">−</span>
                                </button>
                            </form>

                            <span class="text-gray-700">{{ $item->quantity }}</span>

                            <form action="{{ route('cart.increment', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-gray-700">
                                    <span class="text-xl">+</span>
                                </button>
                            </form>
                        </div>

                        <div class="text-right">
                            <p class="font-medium">Total: {{ $item->quantity * $item->product->price }} Lei</p>
                        </div>

                        <div class="flex space-x-2">
                            <button class="text-gray-400 hover:text-red-500">
                                <x-heroicon-o-heart class="w-6 h-6" />
                            </button>
                            <form action="{{ route('cart.remove-item', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500">
                                    <x-heroicon-o-trash class="w-6 h-6" />
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-gray-500">Coșul tău este gol</p>
                        <a href="{{ route('products.index') }}"
                            class="mt-4 inline-block text-primary-600 hover:text-primary-500">
                            Continuă cumpărăturile
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-medium mb-4">Reduceri</h2>

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Valoare comandă</span>
                        <span class="font-medium">{{ $subtotal }} Lei</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Livrare</span>
                        <span class="font-medium">{{ $shipping }} Lei</span>
                    </div>
                    <div class="border-t pt-4">
                        <div class="flex justify-between">
                            <span class="font-medium">Total</span>
                            <span class="font-medium">{{ $total }} Lei</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}" class="mt-6 w-full inline-flex justify-center items-center px-6 py-3 border border-transparent 
                              text-base font-medium rounded-md text-black bg-primary-600 hover:bg-primary-700">
                    Mergi la finalizarea comenzii
                </a>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-16">
        <h2 class="text-xl font-medium mb-6">S-ar putea să-ți placă și</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($relatedProducts as $product)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-medium">{{ $product->name }}</h3>
                        <p class="text-gray-600">{{ $product->price }} lei</p>
                        <p class="text-sm text-gray-500">Material: {{ $product->material }}</p>
                        <button class="mt-4 w-full bg-white border border-gray-300 rounded-md py-2 px-4 
                                                 hover:bg-gray-50">
                            Adaugă
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection