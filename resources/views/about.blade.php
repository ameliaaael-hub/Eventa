<x-default_layout>
    <div class="bg-white text-gray-800">
        <!-- Hero Section - About Us -->
        <section
          class="pt-32 text-white text-center pb-20 bg-center bg-cover bg-no-repeat relative"
          style="background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%)"
        >
          <!-- CHANGE: Gradient background untuk hero section -->
          <div class="absolute inset-0 opacity-30">
            <!-- KOMENTAR: Tambahkan background image dengan silhouette tangan di sini jika diperlukan -->
          </div>
          <div class="relative z-10">
            <h1 class="text-5xl font-bold mb-4">About Us</h1>
            <p class="max-w-2xl mx-auto text-lg px-6">
              Sri Lanka's ultimate platform for exploring all the exciting events happening across universities nationwide.
            </p>
          </div>
        </section>

        <!-- Description Section -->
        <section class="py-16 px-6 bg-white text-center">
          <p class="max-w-3xl mx-auto text-gray-700 text-lg leading-relaxed">
            Sri Lanka's ultimate platform for exploring all the exciting events happening across universities nationwide.
          </p>
        </section>

        <!-- What We Offer Section -->
        <section class="py-20 px-6 bg-gray-50">
          <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-16">What We Offer</h2>
            
            <div class="space-y-12">
              <!-- Free Events -->
              <div class="flex gap-8 items-start">
                <div class="flex-1">
                  <h3 class="text-xl font-bold text-gray-900 mb-3">Free Events:</h3>
                  <p class="text-gray-700 leading-relaxed">
                    Discover a wide variety of free events happening at universities across Sri Lanka, from academic seminars to fun social gatherings.
                  </p>
                </div>
              </div>

              <!-- Event Booking -->
              <div class="flex gap-8 items-start">
                <div class="flex-1">
                  <h3 class="text-xl font-bold text-gray-900 mb-3">Event Booking:</h3>
                  <p class="text-gray-700 leading-relaxed">
                    Reserve your spot for events directly through our platform. Whether it's a workshop, a guest lecture, or a social event, booking is quick and easy.
                  </p>
                </div>
              </div>

              <!-- Event Profile -->
              <div class="flex gap-8 items-start">
                <div class="flex-1">
                  <h3 class="text-xl font-bold text-gray-900 mb-3">Event Profile:</h3>
                  <p class="text-gray-700 leading-relaxed">
                    Create your profile to track events you've registered for, manage your bookings, and add your favorite events to keep them handy.
                  </p>
                </div>
              </div>

              <!-- Explore & Discover -->
              <div class="flex gap-8 items-start">
                <div class="flex-1">
                  <h3 class="text-xl font-bold text-gray-900 mb-3">Explore & Discover:</h3>
                  <p class="text-gray-700 leading-relaxed">
                    Browse through a diverse range of events, filter them by categories or dates, and never miss out on something interesting happening at your university or beyond.
                  </p>
                </div>
              </div>
            </div>

            <!-- KOMENTAR: Tambahkan dekorasi shapes/blobs di bagian ini jika diperlukan (warna ungu, kuning, abu-abu) -->
          </div>
        </section>

        <!-- Our Contributors Section -->
        <section class="py-20 px-6 bg-white">
          <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-16">Our Contributors</h2>
            
            <!-- KOMENTAR: Background decorative shapes di belakang ini -->
            
            <!-- First Row of Contributors -->
            <div class="flex flex-wrap justify-center gap-8 mb-12">
              @for ($i = 0; $i < 3; $i++)
                <div class="flex flex-col items-center">
                  <!-- KOMENTAR: Ganti dengan image logo universitas: src="path/to/university-logo.png" -->
                  <img src="/placeholder.svg?height=80&width=80" alt="University of Moratuwa" class="h-20 w-20 mb-2">
                  <p class="text-center text-sm font-semibold">University of Moratuwa</p>
                  <p class="text-center text-xs text-gray-600">Centre for Biomedical Innovation</p>
                </div>
              @endfor
            </div>

            <!-- Second Row of Contributors -->
            <div class="flex flex-wrap justify-center gap-8">
              @for ($i = 0; $i < 2; $i++)
                <div class="flex flex-col items-center">
                  <!-- KOMENTAR: Ganti dengan image logo universitas: src="path/to/university-logo.png" -->
                  <img src="/placeholder.svg?height=80&width=80" alt="University of Moratuwa" class="h-20 w-20 mb-2">
                  <p class="text-center text-sm font-semibold">University of Moratuwa</p>
                  <p class="text-center text-xs text-gray-600">Centre for Biomedical Innovation</p>
                </div>
              @endfor
            </div>
          </div>
        </section>

        <!-- Join With Us Section -->
        <section class="py-20 px-6 bg-gray-50">
          <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-8">Join With Us</h2>
            <p class="text-gray-700 text-lg leading-relaxed mb-12">
              At [Your Organization Name], we're more than just a group—we're a movement. Joining us means becoming a part of a passionate and vibrant community united by shared values and a vision for the future. Together, we strive to make an impact, drive innovation, and create opportunities that matter.
            </p>

            <!-- Testimonials Carousel -->
            <div class="flex gap-6 overflow-x-auto pb-6">
              @for ($i = 0; $i < 3; $i++)
                <div class="shrink-0 w-80 bg-white p-6 rounded-lg shadow-md">
                  <div class="flex items-center gap-4 mb-4">
                    <img src="/placeholder.svg?height=50&width=50" alt="Taylor Swift" class="h-12 w-12 rounded-full">
                    <div class="text-left">
                      <p class="font-semibold text-gray-900">Taylor Swift</p>
                      <div class="flex text-yellow-500">
                        @for ($j = 0; $j < 5; $j++)
                          <span>★</span>
                        @endfor
                      </div>
                    </div>
                  </div>
                  <p class="text-gray-700 text-sm leading-relaxed">
                    Sekarang, kami bias produksi liket fiik untuk eventu bersama Rostikbos. Hanya perlu mengkuti beberapa langkah mudah.
                  </p>
                </div>
              @endfor
            </div>
          </div>
        </section>
    </div>
</x-default_layout>
