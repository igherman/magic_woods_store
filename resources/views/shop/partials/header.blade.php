<header class="py-4 px-6 border-b">
    <div class="container mx-auto">
        <div class="flex items-center justify-between">
            {{-- Left Navigation --}}
            <nav class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-brown-900 hover:text-brown-700">Acasă</a>
                <a href="{{ route('products.index') }}" class="text-brown-900 hover:text-brown-700">Catalog</a>
            </nav>

            {{-- Logo Center --}}
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <img src="{{ asset('images/logo.svg') }}" alt="MagicWood Creative Toys" class="h-16">
            </a>

            {{-- Right Navigation --}}
            <div class="flex items-center space-x-6">
                <a href="{{ route('wishlist') }}" class="text-brown-900 hover:text-brown-700">
                    <img src="{{ asset('images/icons/heart.svg') }}" alt="Wishlist" class="h-6 w-6">
                </a>
                <a href="{{ route('cart.index') }}" class="text-brown-900 hover:text-brown-700">
                    <img src="{{ asset('images/icons/shopping-bag.svg') }}" alt="Cart" class="h-6 w-6">
                </a>
                <a href="https://wa.me/your-whatsapp-number" 
                   class="flex items-center px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">
                    <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp" class="h-5 w-5 mr-2">
                    <span>Sună-ne!</span>
                </a>
            </div>
        </div>
    </div>
</header>
