@extends('layouts.shop')

@section('title', 'Wishlist')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-green-800 mb-8">My Wishlist</h1>

    @if($wishlist->items->isEmpty())
        <p class="text-gray-600">Your wishlist is empty.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($wishlist->items as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $item->product->getFirstMediaUrl('product_images') }}" 
                         alt="{{ $item->product->name }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2">{{ $item->product->name }}</h3>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('products.show', $item->product) }}" 
                               class="text-brown-700 hover:underline">
                                Vezi detalii
                            </a>
                            <form action="{{ route('wishlist.remove', $item->product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 