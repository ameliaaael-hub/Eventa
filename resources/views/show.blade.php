<x-default_layout>
    <div class="min-h-screen bg-gray-50 pt-24 pb-12">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Event Header -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                @if($acara->Gambar)
                    <img src="{{ asset('storage/' . $acara->Gambar) }}" alt="{{ $acara->Nama }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                        <span class="text-white text-9xl">🎉</span>
                    </div>
                @endif

                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex-1">
                            <span class="bg-purple-100 text-purple-700 text-sm font-semibold px-4 py-2 rounded-full">
                                {{ $acara->Kategori }}
                            </span>
                            <h1 class="text-4xl font-bold text-gray-900 mt-4 mb-2">{{ $acara->Nama }}</h1>
                            <p class="text-gray-500">Event ID: #{{ $acara->id }}</p>
                        </div>
                        
                        @auth
                            @if(Auth::user()->role === 'admin' || $acara->user_id === Auth::id())
                                <div class="flex gap-3">
                                    <a href="{{ route('acara.edit', $acara->id) }}" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit Event
                                    </a>
                                    <form action="{{ route('acara.destroy', $acara->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <!-- Event Details Grid -->
                    <div class="grid md:grid-cols-3 gap-6 mb-8">
                        <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-lg">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Date</p>
                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($acara->Tanggal)->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 bg-pink-50 rounded-lg">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Time</p>
                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($acara->Waktu)->format('H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 bg-blue-50 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Location</p>
                                <p class="font-semibold text-gray-900">{{ $acara->Lokasi }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Event</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $acara->Deskripsi }}</p>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Comments ({{ $komentar->count() }})</h2>

                <!-- Add Comment Form -->
                @auth
                    <div class="mb-8">
                        <form action="{{ route('komentar.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="id_event" value="{{ $acara->id }}">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Your Comment</label>
                                <textarea name="deskripsi" rows="4" required placeholder="Share your thoughts about this event..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none resize-none"></textarea>
                            </div>

                            <button type="submit" 
                                class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold px-8 py-3 rounded-lg transition">
                                Post Comment
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg text-center">
                        <p class="text-gray-600 mb-4">Please <a href="{{ route('login') }}" class="text-purple-600 hover:underline font-semibold">login</a> to post a comment</p>
                    </div>
                @endauth

                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse($komentar as $comment)
                        <div class="border-b border-gray-200 pb-6 last:border-0">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ strtoupper(substr($comment->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $comment->nama }}</h4>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                
                                @auth
                                    @if(Auth::user()->role === 'admin' || $comment->user_id === Auth::id())
                                        <form action="{{ route('komentar.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                            <p class="text-gray-700 leading-relaxed ml-15">{{ $comment->deskripsi }}</p>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="fixed bottom-6 right-6 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in" id="successAlert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('successAlert');
                if(alert) {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    @endif
</x-default_layout>