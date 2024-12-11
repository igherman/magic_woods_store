@extends('layouts.shop')

@section('title', 'Comandă Plasată cu Succes')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
    <h1 class="text-2xl font-semibold mb-8">Comanda a fost plasată cu succes!</h1>

    <div class="mb-8">
        <a href="{{ route('products.index') }}" class="text-primary-600 hover:text-primary-500">
            Înapoi la catalog
        </a>
        <span class="mx-4">|</span>
        <a href="{{ route('home') }}" class="text-primary-600 hover:text-primary-500">
            Vezi pagina de pornire
        </a>
    </div>
</div>
@endsection 