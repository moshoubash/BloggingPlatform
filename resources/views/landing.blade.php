<x-app-layout>
    @section('landing-style')
        <style>
            @keyframes floatPicture {
                0% {
                    transform: translateY(0px) rotate(0deg);
                }
                50% {
                    transform: translateY(-15px) rotate(3deg);
                }
                100% {
                    transform: translateY(0px) rotate(0deg);
                }
            }
        </style>
    @endsection
    <main class="bg-gray-900 text-gray-300 font-serif">
        <section class="hero-section text-gray-300">
            <div class="max-w-7xl mx-auto px-5 py-24">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-3/5 mb-10 md:mb-0">
                        <h2 class="font-serif text-6xl sm:text-7xl font-bold text-gray-300 mb-5 leading-tight">
                            Don't<br>Think! &amp; Write
                        </h2>
                        <p class="text-xl text-gray-400 mb-8 max-w-lg">
                            A place to read, write, and deepen your understanding.
                        </p>
                        <a href="/home" class="inline-block px-6 py-3 rounded-full border border-purple-400 text-purple-400 font-medium hover:bg-purple-400 hover:text-gray-900 transition duration-300">
                            Start Reading
                        </a>
                    </div>
                    <div class="md:w-2/5 relative">
                        <img src="{{asset('images/nobackpen.png')}}" alt="Illustration of writing and creativity" class="p-5 h-96 w-96 animate-[floatPicture_8s_ease-in-out_infinite] transform-origin-bottom-center border-2 border-purple-400 rounded-lg">
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>