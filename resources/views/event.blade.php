<x-default_layout>
    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-purple-600 via-purple-500 to-pink-500 text-white text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 max-w-6xl mx-auto px-6">
            <h1 class="text-5xl font-bold mb-8">All Events</h1>
            
            <!-- Filter Section -->
            <div class="flex justify-center gap-4 flex-wrap">
                <select class="bg-white text-gray-800 px-6 py-3 rounded-lg font-medium focus:ring-2 focus:ring-purple-300 outline-none">
                    <option>Upcoming</option>
                    <option>This Week</option>
                    <option>This Month</option>
                </select>
                <select class="bg-white text-gray-800 px-6 py-3 rounded-lg font-medium focus:ring-2 focus:ring-purple-300 outline-none">
                    <option>Popular</option>
                    <option>Most Viewed</option>
                    <option>Trending</option>
                </select>
                <select class="bg-white text-gray-800 px-6 py-3 rounded-lg font-medium focus:ring-2 focus:ring-purple-300 outline-none">
                    <option>Latest</option>
                    <option>Oldest</option>
                </select>
            </div>

            <!-- Add Event Button -->
            <div class="mt-8">
                <a href="{{ route('acara.create') }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-8 py-3 rounded-lg transition duration-300 shadow-lg">
                    + Add Event
                </a>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section class="max-w-7xl mx-auto py-12 px-6">
        @if($acara->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($acara as $event)
                    <div class="bg-white shadow-lg rounded-2xl overflow-hidden hover:-translate-y-2 transition duration-300 relative">
                        <!-- Event Image -->
                        <a href="{{ route('acara.show', $event->id) }}" class="block">
                            @if($event->Gambar)
                                <img src="{{ asset('storage/' .$event->Gambar) }}" alt="{{ $event->Nama }}" class="w-full h-48 object-cover">
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

                            <!-- Category Badge & Actions -->
                            <div class="flex items-center justify-between">
                                <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $event->Kategori }}
                                </span>
                                <div class="flex gap-2">
                                    <a href="{{ route('acara.edit', $event->id) }}" class="text-blue-500 hover:text-blue-700" onclick="event.stopPropagation()">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('acara.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')" onclick="event.stopPropagation()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-6xl mb-4">📅</div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No Events Yet</h3>
                <p class="text-gray-500 mb-6">Start adding your first event!</p>
                <a href="{{ route('acara.create') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold px-8 py-3 rounded-lg transition">
                    Add Your First Event
                </a>
            </div>
        @endif
    </section>

    @if(session('success'))
        <div class="fixed bottom-6 right-6 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" id="successAlert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('successAlert').style.display = 'none';
            }, 3000);
        </script>
    @endif
</x-default_layout>