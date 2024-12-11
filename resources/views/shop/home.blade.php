@extends('layouts.shop')

@section('title', 'Acasă')

@section('content')
{{-- Hero Section --}}
<section class="container mx-auto px-6 py-12 flex items-center justify-between">
    <div class="max-w-xl">
        <h1 class="text-4xl font-bold text-green-800 mb-4">
            Bun venit în Universul<br>
            Jucăriilor din Lemn
        </h1>
        <p class="text-gray-700 mb-8">
            Descoperă jucăriile noastre din lemn lucrate manual, care trezesc imaginația și aduc zâmbete copiilor
        </p>
        <a href="{{ route('products.index') }}"
            class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition">
            Descoperă colecția
        </a>
    </div>
    <div class="relative">
        <div class="bg-green-100 rounded-full w-[500px] h-[500px] overflow-hidden">
            <img src="{{ asset('images/hero-image.jpg') }}" alt="Kid playing with wooden toy" class="object-cover">
        </div>
    </div>
</section>

{{-- Featured Products Section --}}
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold text-center text-green-800 mb-12">Recomandări de la noi</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($featuredProducts as $product)
            <div class="bg-white rounded-lg overflow-hidden shadow-md">
                <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('products.show', $product) }}" class="text-brown-700 hover:underline">Vezi
                            detalii</a>
                        <button class="px-4 py-2 border border-green-600 rounded hover:bg-green-50 transition">
                            Adaugă
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-8">
        <a href="{{ route('products.index') }}"
            class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition">
            Vezi toate jucăriile
        </a>
    </div>
</section>

{{-- Features Section --}}
<section class="bg-green-50 py-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8 text-center">
            <div>
                <img src="{{ asset('images/icons/creative.svg') }}" alt="Creative" class="h-16 mx-auto mb-4">
                <p class="text-sm text-brown-700">Jucăriile noastre din lemn inspiră jocul creativ.</p>
            </div>
            <div>
                <img src="{{ asset('images/icons/puzzle.svg') }}" alt="Development" class="h-16 mx-auto mb-4">
                <p class="text-sm text-brown-700">Proiectate pentru a susține dezvoltarea cognitivă și învățarea prin
                    joc.</p>
            </div>
            <div>
                <img src="{{ asset('images/icons/handmade.svg') }}" alt="Handmade" class="h-16 mx-auto mb-4">
                <p class="text-sm text-brown-700">Fiecare jucărie este realizată manual cu mare grijă și atenție la
                    detalii.</p>
            </div>
            <div>
                <img src="{{ asset('images/icons/natural.svg') }}" alt="Natural" class="h-16 mx-auto mb-4">
                <p class="text-sm text-brown-700">Confecționate din lemn 100% natural.</p>
            </div>
            <div>
                <img src="{{ asset('images/icons/eco.svg') }}" alt="Eco" class="h-16 mx-auto mb-4">
                <p class="text-sm text-brown-700">Fabricate din materiale non-toxice.</p>
            </div>
        </div>
    </div>
</section>

{{-- Workshops Section --}}
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold text-green-800 mb-8">Ateliere pentru copii!</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        {{-- Workshop images will go here --}}
        <img src="{{ asset('images/workshops/workshop-1.png') }}" alt="Workshop"
            class="rounded-lg w-full h-64 object-cover">
        <img src="{{ asset('images/workshops/workshop-2.png') }}" alt="Workshop"
            class="rounded-lg w-full h-64 object-cover">
        <img src="{{ asset('images/workshops/workshop-3.png') }}" alt="Workshop"
            class="rounded-lg w-full h-64 object-cover">
        <img src="{{ asset('images/workshops/workshop-4.png') }}" alt="Workshop"
            class="rounded-lg w-full h-64 object-cover">
    </div>
</section>

{{-- Testimonials Section --}}
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold text-green-800 mb-8">Ce spun clienții noștri!</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        {{-- Add testimonial cards here --}}
    </div>
</section>
@endsection