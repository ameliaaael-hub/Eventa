<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventa | Home</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body>
  <nav class="w-full bg-white shadow-sm fixed top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
      <a href="{{ route('home') }}" class="text-2xl font-bold text-purple-700"><img src="/mainlogo.png" alt="logo" class="w-40"></a>
      <div class="flex items-center gap-10">
        <ul class="hidden md:flex space-x-8 font-medium text-black">
          <li><a href="{{ route('acara.index') }}" class="hover:text-purple-600">Events</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-purple-600">About</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-purple-600">Contact</a></li>
        </ul>
        <div class="hidden md:flex items-center">
          <form action="{{ route('acara.search') }}" method="GET" class="relative">
            <input type="text" name="q" placeholder="Search events..." value="{{ request('q') }}"
              class="bg-white border border-gray-300 rounded-full pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-purple-400 outline-none w-64">
            <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-purple-600">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
          </form>
        </div>
        <!-- Auth Buttons -->
        <div class="hidden md:flex items-center gap-3">
          @auth
            <div class="relative group">
              <button class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-full font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>{{ Auth::user()->name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              
              <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                @if(Auth::user()->role === 'admin')
                  <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-purple-50 transition">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Admin Dashboard
                  </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-purple-50 transition">
                  <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  Profile
                </a>
                <a href="{{ route('acara.create') }}" class="block px-4 py-2 text-gray-800 hover:bg-purple-50 transition">
                  <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                  </svg>
                  Create Event
                </a>
                <hr class="my-2">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                  </button>
                </form>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="bg-white border-2 border-purple-600 text-purple-600 hover:bg-purple-50 px-6 py-2 rounded-full font-semibold transition">
              Login
            </a>
            <a href="{{ route('register') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-full font-semibold transition">
              Register
            </a>
          @endauth
        </div>
        
        <button class="md:hidden text-gray-600" id="mobileMenuBtn">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
    
    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-white border-t" id="mobileMenu">
      <ul class="py-4 px-6 space-y-3">
        <li><a href="{{ route('acara.index') }}" class="block hover:text-purple-600">Events</a></li>
        <li><a href="{{ route('about') }}" class="block hover:text-purple-600">About</a></li>
        <li><a href="{{ route('contact') }}" class="block hover:text-purple-600">Contact</a></li>
        <li>
          <form action="{{ route('acara.search') }}" method="GET" class="relative">
            <input type="text" name="q" placeholder="Search events..."
              class="w-full bg-gray-100 border border-gray-300 rounded-full pl-10 pr-4 py-2 text-sm">
            <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
          </form>
        </li>
        @auth
          <li><a href="{{ route('dashboard') }}" class="block hover:text-purple-600">Dashboard</a></li>
          <li><a href="{{ route('profile.edit') }}" class="block hover:text-purple-600">Profile</a></li>
          <li><a href="{{ route('acara.create') }}" class="block hover:text-purple-600">Create Event</a></li>
          @if(Auth::user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="block hover:text-purple-600">Admin Dashboard</a></li>
          @endif
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="text-red-600 hover:text-red-700">Logout</button>
            </form>
          </li>
        @else
          <li><a href="{{ route('login') }}" class="block bg-purple-600 text-white text-center py-2 rounded-full">Login</a></li>
          <li><a href="{{ route('register') }}" class="block bg-white border-2 border-purple-600 text-purple-600 text-center py-2 rounded-full">Register</a></li>
        @endauth
      </ul>
    </div>
  </nav>
  
  <section>
    {{$slot}}
  </section>
  
  <!-- Footer -->
  <footer class="bg-[#0B0450] text-white py-12 mt-16">
    <div class="max-w-6xl mx-auto grid md:grid-cols-4 gap-8 px-6">
      <div>
        <p class="text-sm mb-3">Eventa is a global self-service ticketing platform for live experiences that allows anyone to create, share, find, and attend events that fuel their passions.</p>
        <div class="space-x-3">
          <a href="#" class="hover:underline">Facebook</a>
          <a href="#" class="hover:underline">Twitter</a>
          <a href="#" class="hover:underline">LinkedIn</a>
        </div>
      </div>
      <div>
        <h4 class="font-semibold mb-3">Plan Events</h4>
        <ul class="space-y-1 text-sm">
          <li><a href="#" class="hover:underline">Create and Set Up</a></li>
          <li><a href="#" class="hover:underline">Sell Tickets</a></li>
          <li><a href="#" class="hover:underline">Online RSVP</a></li>
          <li><a href="#" class="hover:underline">Online Events</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold mb-3">Eventick</h4>
        <ul class="space-y-1 text-sm">
          <li><a href="#" class="hover:underline">About Us</a></li>
          <li><a href="#" class="hover:underline">Press</a></li>
          <li><a href="#" class="hover:underline">Contact Us</a></li>
          <li><a href="#" class="hover:underline">Help Center</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold mb-3">Stay In The Loop</h4>
        <p class="text-sm mb-2">Join our mailing list to stay in the loop with our newest Event and concert.</p>
      </div>
    </div>
    <div class="border-t border-white/20 mt-8 pt-6 text-center text-sm">
      © 2025 EVENTA. All rights reserved.
    </div>
  </footer>
  
  <script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    mobileMenuBtn?.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>