@extends('layouts.shop')

@section('title', $product->name)

@section('content')
    <section class="container mx-auto px-4 py-8">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Product Images -->
            <section class="relative">
                <!-- Main Image -->
                <div class="mb-4 relative">
                    <img src="{{ $product->getFirstMediaUrl('product_images', 'large') }}" 
                         alt="{{ $product->name }}"
                         class="w-full rounded-lg">
                    <button class="absolute top-4 right-4 p-2 rounded-full bg-white/80 hover:bg-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                    <!-- Navigation Arrows -->
                    <button class="absolute left-4 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/80 hover:bg-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="absolute right-4 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/80 hover:bg-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
                <!-- Thumbnail Images -->
                <div class="grid grid-cols-4 gap-4">
                    @foreach($product->getMedia('product_images') as $media)
                        <img src="{{ $media->getUrl('thumb') }}" 
                             alt="Thumbnail {{ $loop->iteration }}"
                             class="w-full rounded-lg cursor-pointer">
                    @endforeach
                </div>
            </section>

            <!-- Product Info -->
            <section class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                    <p class="text-2xl font-bold">{{ $product->price }} lei</p>
                </div>

                <button class="w-full bg-white border-2 border-gray-800 text-gray-800 py-3 px-6 rounded-lg hover:bg-gray-800 hover:text-white transition">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Adaugă
                    </span>
                </button>

                <!-- Product Description -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold">Descriere produs</h2>
                    <div class="prose max-w-none">
                        {{ $product->description }}
                        
                        @if($product->material)
                            <ul class="mt-4">
                                <li>Material: {{ $product->material }}</li>
                                @if($product->dimensions)
                                    <li>Dimensiuni: {{ $product->dimensions }}</li>
                                @endif
                                @if($product->weight)
                                    <li>Greutate: {{ $product->weight }} grame</li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Shipping Info -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold">Livrare și plată</h2>
                    <div class="prose max-w-none">
                        <p>Livrare gratuită pentru comenzi de minimum 200 LEI.</p>
                        <p>Livrare: Transportul se efectuează către adresa de domiciliu sau către alte adrese din România.</p>
                        <p>Plată: Acceptăm plată cu carduri MasterCard, Maestro și Visa.</p>
                    </div>
                </div>
            </section>
        </div>

        <!-- Related Products -->
        <section class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Articole asemanatoare</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProducts as $related)
                    <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="relative">
                            <img src="{{ $related->getFirstMediaUrl('product_images', 'thumb') }}" 
                                 alt="{{ $related->name }}"
                                 class="w-full h-48 object-cover">
                            <button class="absolute top-2 right-2 p-2 rounded-full bg-white/80 hover:bg-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold">{{ $related->name }}</h3>
                                <span class="text-lg font-bold">{{ $related->price }} lei</span>
                            </div>
                            @if($related->material)
                                <p class="text-sm text-gray-600 mb-4">Material: {{ $related->material }}</p>
                            @endif
                            <button class="w-full bg-white border-2 border-gray-800 text-gray-800 py-2 px-4 rounded hover:bg-gray-800 hover:text-white transition">
                                Adaugă
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </section>
@endsection
