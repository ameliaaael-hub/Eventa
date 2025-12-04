<x-default_layout>
    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-purple-600 via-purple-500 to-pink-500 text-white text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 max-w-6xl mx-auto px-6">
            <h1 class="text-5xl font-bold mb-4">Search Results</h1>
            @if($query)
                <p class="text-xl">Showing results for: <span class="font-semibold">"{{ $query }}"</span></p>
            @endif
        </div>
    </section>

    <!-- Search Results -->
    <section class="max-w-7xl mx-auto py-12 px-6">
        @if($acara->count() > 0)
            <p class="text-gray-600 mb-6">Found {{ $acara->count() }} event(s)</p>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($acara as $event)
                    <div class="bg-white shadow-lg rounded-2xl overflow-hidden hover:-translate-y-2 transition duration-300 relative">
                        <!-- Event Image -->
                        <a href="{{ route('acara.show', $event->id) }}" class="block">
                            @if($event->Gambar)
                                <img src="{{ asset($event->Gambar) }}" alt="{{ $event->Nama }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                                    <span class="text-white text-4xl">🎉</span>
                                </div>
                            @endif
                        </a>
                        
                        <!-- Free Badge -->
                        <span class="absolute top-3 right-3 bg-pink-500 text-white text-xs font-bold px-3 py-1 rounded-full">FREE</span>
                        
                        <!-- Event Info -->
                        <div class="p-5">
                            <!-- Date -->
                            <a href="{{ route('acara.show', $event->id) }}" class="block">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="text-center bg-purple-100 rounded-lg px-3 py-2">
                                        <p class="text-xs text-purple-600 font-semibold">{{ \Carbon\Carbon::parse($event->Tanggal)->format('M') }}</p>
                                        <p class="text-2xl font-bold text-purple-700">{{ \Carbon\Carbon::parse($event->Tanggal)->format('d') }}</p>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800 line-clamp-2">{{ $event->Nama }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{{ $event->Waktu }}</p>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $event->Deskripsi }}</p>
                                
                                <!-- Location -->
                                <div class="flex items-center text-gray-500 text-sm mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="line-clamp-1">{{ $event->Lokasi }}</span>
                                </div>
                            </a>

                            <!-- Category Badge -->
                            <div class="flex items-center justify-between">
                                <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $event->Kategori }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No Events Found</h3>
                <p class="text-gray-500 mb-6">Sorry, we couldn't find any events matching "{{ $query }}"</p>
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('acara.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-8 py-3 rounded-lg transition">
                        Browse All Events
                    </a>
                    <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition">
                        Back to Home
                    </a>
                </div>
            </div>
        @endif
    </section>
</x-default_layout>