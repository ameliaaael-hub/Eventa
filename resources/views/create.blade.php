<x-default_layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 pt-24 pb-12">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Event Submission</h1>
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('acara.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <input type="text" name="Nama" placeholder="Event Title" value="{{ old('Nama') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
                            </div>

                            <!-- Date & Time -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                    <input type="date" name="Tanggal" value="{{ old('Tanggal') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                                    <input type="time" name="Waktu" value="{{ old('Waktu') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none">
                                </div>
                            </div>

                            <!-- Location -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                <input type="text" name="Lokasi" placeholder="Location" value="{{ old('Lokasi') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none">
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                <select name="Kategori" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none">
                                    <option value="">Select Category</option>
                                    <option value="Music" {{ old('Kategori') == 'Music' ? 'selected' : '' }}>Music</option>
                                    <option value="Sports" {{ old('Kategori') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Education" {{ old('Kategori') == 'Education' ? 'selected' : '' }}>Education</option>
                                    <option value="Business" {{ old('Kategori') == 'Business' ? 'selected' : '' }}>Business</option>
                                    <option value="Entertainment" {{ old('Kategori') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="Deskripsi" rows="4" placeholder="Event description..." required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none resize-none">{{ old('Deskripsi') }}</textarea>
                            </div>
                        </div>

                        <!-- Right Column - Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Event Image</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg h-80 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition cursor-pointer relative"
                                id="dropZone">
                                <input type="file" name="Gambar" id="imageInput" accept="image/*" class="hidden">
                                <svg class="w-12 h-12 text-gray-400 mb-3" id="uploadIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="text-gray-600 text-center px-4" id="uploadText">
                                    Drag & Drop or 
                                    <label for="imageInput" class="text-purple-600 hover:text-purple-700 cursor-pointer">Choose file</label>
                                    to upload image
                                </p>
                                <img id="preview" class="hidden w-full h-full object-cover rounded-lg absolute inset-0">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold py-3 rounded-lg hover:from-pink-600 hover:to-purple-700 transition duration-300">
                            Submit Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');
        const uploadIcon = document.getElementById('uploadIcon');
        const uploadText = document.getElementById('uploadText');

        dropZone.addEventListener('click', () => imageInput.click());

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    uploadIcon.classList.add('hidden');
                    uploadText.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-purple-500', 'bg-purple-50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-purple-500', 'bg-purple-50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-purple-500', 'bg-purple-50');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                imageInput.files = e.dataTransfer.files;
                const event = new Event('change');
                imageInput.dispatchEvent(event);
            }
        });
    </script>
</x-default_layout>