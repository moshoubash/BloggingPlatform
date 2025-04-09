<x-app-layout>
    @section('landing-style')
        <style>
            /* Simplified animations with better timing */
            @keyframes fade-in {
                0% { opacity: 0; transform: translateY(20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
            
            /* Cleaner animation delays */
            .animation-delay-300 { animation-delay: 300ms; }
            .animation-delay-500 { animation-delay: 500ms; }
            .animation-delay-700 { animation-delay: 700ms; }
            .animation-delay-900 { animation-delay: 900ms; }
            
            /* Simplified animations */
            .animate-fade-in { animation: fade-in 0.8s forwards ease-out; }
            .animate-float { animation: float 5s infinite ease-in-out; }
            
            /* Modern box shadows and effects */
            .shadow-soft {
                box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.3);
            }
            
            .gradient-text {
                background-size: 100% 100%;
            }
            
            /* Modern button styles */
            .modern-btn {
                position: relative;
                overflow: hidden;
                z-index: 1;
                transition: all 0.3s ease;
            }
            
            .modern-btn:hover {
                transform: translateY(-2px);
            }
            
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }
            
            ::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.1);
            }
            
            ::-webkit-scrollbar-thumb {
                background: #5eead4;
                border-radius: 10px;
            }
        </style>
    @endsection
    
    <main class="relative min-h-screen bg-gradient-to-b from-gray-950 to-gray-900 overflow-hidden">
        <!-- Main Content Container -->
        <div class="relative z-10 container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
            <!-- Hero Section with Clean Animation -->
            <section class="relative opacity-0 animate-fade-in animation-delay-300 duration-700">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/2 lg:w-3/5">
                        <div class="max-w-xl">
                            <!-- Main Title with Simplified Gradient -->
                            <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-purple-600 tracking-tighter leading-tight mb-6 gradient-text">
                                Don't<br>Think! &amp; Write
                            </h1>
                            
                            <!-- Clean Badge -->
                            <div class="inline-block opacity-0 animate-fade-in animation-delay-500 duration-700 mb-4">
                                <span class="px-3 py-1 text-xs font-semibold text-white rounded-full bg-gradient-to-r from-teal-500 to-purple-600 shadow-soft">
                                    New Experience
                                </span>
                            </div>
                            
                            <!-- Clean Subtitle -->
                            <p class="text-xl sm:text-2xl text-gray-300 leading-relaxed mb-8 opacity-0 animate-fade-in animation-delay-500 duration-700">
                                Unleash your creativity in a space where <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-purple-500">ideas flow</span> and <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500">understanding deepens</span>.
                            </p>
                            
                            <!-- Modern Feature List -->
                            <div class="space-y-4 mb-8 opacity-0 animate-fade-in animation-delay-700 duration-700">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-teal-500 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-300">Distraction-free writing environment</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-purple-500 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-300">Connect with like-minded creators</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-pink-500 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-300">Discover inspiring content daily</p>
                                </div>
                            </div>
                            
                            <!-- Modern CTA Buttons -->
                            <div class="flex flex-wrap gap-4 opacity-0 animate-fade-in animation-delay-900 duration-700">
                                <a href="/home" class="modern-btn inline-block px-8 py-4 rounded-lg bg-gradient-to-r from-teal-500 to-purple-600 text-white font-medium transition-all shadow-soft">
                                    Start Reading
                                </a>
                                <a href="/register" class="modern-btn inline-block px-8 py-4 rounded-lg border border-purple-500/50 text-white font-medium hover:bg-purple-500/10 transition-all backdrop-blur-sm">
                                    Sign Up Free
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Clean Image Section -->
                    <div class="mt-16 md:mt-0 md:w-1/2 lg:w-2/5 opacity-0 animate-fade-in animation-delay-500 duration-700">
                        <div class="relative group max-w-md mx-auto">
                            <!-- Simple Glow Effect -->
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-teal-500/20 to-purple-600/20 rounded-xl blur-sm transform transition-all group-hover:scale-[1.02] group-hover:-inset-1 group-hover:blur-md duration-300"></div>
                            
                            <!-- Clean Image Container -->
                            <div class="relative p-6 bg-gray-900/50 rounded-xl overflow-hidden border border-gray-800 shadow-soft">
                                <!-- Simple Top Bar -->
                                <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-teal-400 to-purple-600"></div>
                                
                                <!-- Main Image with Simple Animation -->
                                <img src="{{asset('images/nobackpen.png')}}" alt="Illustration of writing and creativity" class="w-full max-w-sm mx-auto transform transition-all group-hover:scale-[1.02] duration-300 animate-float animation-delay-500">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-app-layout>