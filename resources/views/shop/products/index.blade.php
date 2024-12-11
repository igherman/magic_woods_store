@extends('layouts.shop')

@section('title', 'Produse')

@section('content')
    <section class="container mx-auto px-4 py-8">
        <div class="grid md:grid-cols-4 gap-6">
            <!-- Categories Sidebar -->
            <section class="col-span-full md:col-span-1">
                <div class="space-y-4">
                    <section class="border-b pb-4">
                        <h2 class="text-lg font-semibold mb-2">Categorie</h2>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('products.index') }}" 
                                   class="text-gray-600 hover:text-gray-900 {{ !request('category') ? 'font-semibold text-gray-900' : '' }}">
                                    Toate produsele
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                                       class="text-gray-600 hover:text-gray-900 {{ request('category') === $category->slug ? 'font-semibold text-gray-900' : '' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
            </section>

            <!-- Products Grid -->
            <section class="col-span-full">
                <div class="grid">
                    @foreach($products as $product)
                        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative">
                                <img src="{{ $product->getFirstMediaUrl('product_images', 'thumb') }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-40 object-cover">
                                <button class="absolute top-2 right-2 p-2 rounded-full bg-white/80 hover:bg-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                    <span class="text-lg font-bold">{{ $product->price }} lei</span>
                                </div>
                                @if($product->material)
                                    <p class="text-sm text-gray-600 mb-4">Material: {{ $product->material }}</p>
                                @endif
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="flex-1 text-center text-gray-600 hover:text-gray-900">
                                        Vezi detalii
                                    </a>
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" 
                                            class="w-full bg-white border-2 border-gray-800 text-gray-800 py-2 px-8 rounded hover:bg-gray-800 hover:text-white transition">
                                            Adaugă în coș
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <section class="mt-8 flex justify-center items-center gap-2">
                    {{ $products->links() }}
                </section>
            </section>
        </div>
    </section>
@endsection
