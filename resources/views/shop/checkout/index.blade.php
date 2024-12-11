@extends('layouts.shop')

@section('title', 'Finalizare comandă')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-semibold mb-8">Finalizare comandă</h1>

    <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <!-- Order Details Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 space-y-6">
                <div class="space-y-6">
                    <h2 class="text-lg font-medium">Datele mele</h2>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Prenume*</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <p class="mt-1 text-xs text-gray-500">Vă rugăm să introduceți prenumele dvs.</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nume*</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <p class="mt-1 text-xs text-gray-500">Vă rugăm să introduceți numele dvs.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-mail*</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <p class="mt-1 text-xs text-gray-500">Vă rugăm să introduceți adresa de e-mail</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Număr de telefon*</label>
                        <div class="mt-1 flex">
                            <select name="phone_prefix" class="rounded-l-md border-r-0 border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                <option value="+40">România (+40)</option>
                            </select>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required
                                   class="flex-1 rounded-r-md border-l-0 border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Vă rugăm să introduceți numărul dvs. de telefon</p>
                    </div>

                    <!-- Billing Address -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium">Adresa de facturare</h2>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Adresă*</label>
                            <input type="text" name="billing_address" value="{{ old('billing_address') }}" required
                                   placeholder="Strada, număr, bloc, etaj, apartament"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Localitate/Oraș*</label>
                                <input type="text" name="billing_city" value="{{ old('billing_city') }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cod Poștal*</label>
                                <input type="text" name="billing_postal_code" value="{{ old('billing_postal_code') }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium">Adresa de livrare</h2>
                        <div class="flex items-center">
                            <input type="checkbox" name="same_as_billing" id="same_as_billing" class="rounded border-gray-300 text-primary-600">
                            <label for="same_as_billing" class="ml-2 text-sm text-gray-700">
                                Adresa de livrare este aceeași cu adresa de facturare.
                            </label>
                        </div>

                        <div id="shipping_address_fields">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Adresă*</label>
                                <input type="text" name="shipping_address" value="{{ old('shipping_address') }}"
                                       placeholder="Strada, număr, bloc, etaj, apartament"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Localitate/Oraș*</label>
                                    <input type="text" name="shipping_city" value="{{ old('shipping_city') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Cod Poștal*</label>
                                    <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                </div>
                            </div>
                        </div>
                    </div>
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

                <button type="submit" 
                        class="mt-6 w-full inline-flex justify-center items-center px-6 py-3 border border-transparent 
                               text-base font-medium rounded-md text-black bg-primary-600 hover:bg-primary-700">
                    Finalizare cumpărături
                </button>

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
    </form>
</div>

@push('scripts')
<script>
    document.getElementById('same_as_billing').addEventListener('change', function() {
        const shippingFields = document.getElementById('shipping_address_fields');
        shippingFields.style.display = this.checked ? 'none' : 'block';
    });
</script>
@endpush
@endsection 