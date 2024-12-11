<footer class="bg-green-50 py-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Support Section --}}
            <div>
                <h3 class="text-xl font-semibold text-brown-900 mb-4">Suport clienti</h3>
                <div class="space-y-3">
                    <p class="text-brown-700">9<sup>00</sup>–18<sup>00</sup></p>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/icons/phone.svg') }}" alt="Phone" class="w-5 h-5">
                        <a href="tel:0123456789" class="text-brown-700 hover:text-brown-900">+40 734 634 816</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/icons/email.svg') }}" alt="Email" class="w-5 h-5">
                        <a href="mailto:mail@mail.com" class="text-brown-700 hover:text-brown-900">mail@mail.com</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp" class="w-5 h-5">
                        <a href="https://wa.me/0123456789" class="text-brown-700 hover:text-brown-900">+40 734 634 816</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/icons/info.svg') }}" alt="Info" class="w-5 h-5">
                        <a href="#" class="text-brown-700 hover:text-brown-900 underline">Informații utile</a>
                    </div>
                </div>
            </div>

            {{-- Social Media Section --}}
            <div>
                <h3 class="text-xl font-semibold text-brown-900 mb-4">Social media</h3>
                <p class="text-brown-700 mb-4">Urmărește-ne în social media</p>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/profile.php?id=100089893762286" target="blank" class="hover:opacity-80">
                        <img src="{{ asset('images/icons/facebook.svg') }}" alt="Facebook" class="w-10 h-10">
                    </a>
                    <a href="https://www.instagram.com/pino_toys_romania/profilecard/?igsh=MWswZHd0OHZweWthaw==" target="blank" class="hover:opacity-80">
                        <img src="{{ asset('images/icons/instagram.svg') }}" alt="Instagram" class="w-10 h-10">
                    </a>
                </div>
            </div>

            {{-- Newsletter Section --}}
            <div>
                <h3 class="text-xl font-semibold text-brown-900 mb-4">Newsletter</h3>
                <p class="text-brown-700 mb-4">Nu rata ofertele si promotiile noastre</p>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <input type="email" name="email" placeholder="Adresa de email"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brown-700 focus:border-brown-700">
                    </div>
                    <div class="flex items-start space-x-2">
                        <input type="checkbox" name="newsletter_consent" id="newsletter_consent" class="mt-1">
                        <label for="newsletter_consent" class="text-sm text-brown-700">
                            Vreau sa primesc newsletter cu promotiile magazinului. Afla mai multe in
                            <a href="#" class="underline hover:text-brown-900">Politica de Confidențialitate</a>
                        </label>
                    </div>
                    <button type="submit"
                        class="px-6 py-2 bg-brown-700 text-white rounded-lg hover:bg-brown-900 transition">
                        Aboneaza-te
                    </button>
                </form>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="mt-12 text-center text-brown-700">
            <p>©Copyright</p>
        </div>
    </div>
</footer>