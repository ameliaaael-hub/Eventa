<x-default_layout>
<div class="bg-white text-gray-800">

  <!-- Hero Section -->
  <section class="pt-32 text-white text-center pb-20 bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('herobackground.png') }}');">
    <div class="bg-no-repeat bg-cover bg-center w-[70%] m-auto rounded-xl flex flex-col items-start" style="background-image: url('{{ asset('heroimg.png') }}');">
    <div class="p-10 text-start">
      <h1 class="text-5xl font-bold mb-4">EVENTA</h1>
      <p class="max-w-xl text-lg mb-6 text-start">Stay updated with the latest academic talks, workshops, and social gatherings across universities. Whether you're here to network, learn, or have fun, there's something for everyone!</p>
      <a href="{{ route('about') }}" class="bg-pink-500 hover:bg-pink-600 px-6 py-2 rounded-full font-semibold">About Us</a>
    </div>  
      <form method="GET" action="{{ route('home') }}" class="bg-white text-gray-800 mx-auto mt-10 p-6 rounded-2xl shadow-lg w-full">
      <div class="grid md:grid-cols-1 gap-4 text-left">
        <div>
          <label class="font-semibold">Filter by Date:</label>
          <div class="flex gap-2 mt-1">
            <input type="month" name="month" value="{{ $monthFilter }}" class="flex-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400 outline-none">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded-lg transition">Filter</button>
            @if($monthFilter)
              <a href="{{ route('home') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-4 py-2 rounded-lg transition">Clear</a>
            @endif
          </div>
        </div>
      </div>
    </form>
    </div>
      
    <!-- Category Section -->
    <div class="py-16 text-center">
      <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
        <div>
          <div class="w-20 h-20 mx-auto bg-white shadow-md flex items-center justify-center rounded-full text-3xl text-purple-600">🎵</div>
          <p class="mt-3 font-medium">Music Events</p>
        </div>
        <div>
          <div class="w-20 h-20 mx-auto bg-white shadow-md flex items-center justify-center rounded-full text-3xl text-purple-600">👥</div>
          <p class="mt-3 font-medium">Seminar</p>
        </div>
        <div>
          <div class="w-20 h-20 mx-auto bg-white shadow-md flex items-center justify-center rounded-full text-3xl text-purple-600">🎉</div>
          <p class="mt-3 font-medium">Annual Celebrations</p>
        </div>
        <div>
          <div class="w-20 h-20 mx-auto bg-white shadow-md flex items-center justify-center rounded-full text-3xl text-purple-600">🏅</div>
          <p class="mt-3 font-medium">Sport</p>
        </div>
      </div>
    </div>
  </section>


  <!-- Upcoming Events -->
  <section class="max-w-6xl mx-auto py-12 px-6 mb-20">
    <h2 class="text-3xl font-bold text-center mb-10">Upcoming Events</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
      @forelse($upcomingEvents as $event)
         <a href="{{ route('acara.show', $event->id) }}">

        <div class="relative bg-white shadow-md rounded-2xl overflow-hidden hover:-translate-y-1 transition">
          @if($event->Gambar)
            <img src="{{ asset($event->Gambar) }}" alt="{{ $event->Nama }}" class="w-full h-48 object-cover">
          @else
            <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
              <span class="text-white text-5xl">🎉</span>
            </div>
          @endif
          <span class="absolute top-3 right-3 bg-pink-500 text-white text-xs font-semibold px-3 py-1 rounded-full">FREE</span>
          <div class="p-4">
            <h3 class="font-semibold text-lg line-clamp-2">{{ $event->Nama }}</h3>
            <p class="text-sm text-gray-500 mt-1 line-clamp-1">{{ $event->Lokasi }}</p>
            <p class="text-xs text-purple-600 mt-2">
              {{ \Carbon\Carbon::parse($event->Tanggal)->format('d M Y') }} • {{ \Carbon\Carbon::parse($event->Waktu)->format('H:i') }}
            </p>
          </div>
        </div>
         </a>

      @empty
        <div class="col-span-full text-center py-10">
          <p class="text-gray-500">No upcoming events available</p>
        </div>
      @endforelse
    </div>
    <div class="text-center mt-8">
      <a href="{{ route('acara.index') }}" class="border border-purple-500 text-purple-600 hover:bg-purple-600 hover:text-white font-semibold px-6 py-2 rounded-full transition">See All Events</a>
    </div>
  </section>
  
  <!-- Add Event Section -->
  <section class="bg-gradient-to-r from-purple-600 to-purple-500 mt-20">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-8">
      <div class="flex-1">
        <img src="{{ asset('image 3.png') }}" alt="People discussing event" class="w-full h-auto -mt-20">
      </div>
      <div class="flex-1 text-white">
        <h2 class="text-4xl font-bold mb-2">Add Your Loving Event</h2>
        <p class="text-lg mb-6">Click the button below to add your event</p>
        <a href="{{ route('acara.create') }}"  class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-3 rounded-lg transition">Add an event</a>
      </div>
    </div>
  </section>
  
  <!-- Past Successful Events -->
  <section class="max-w-6xl mx-auto py-12 px-6">
    <h2 class="text-3xl font-bold text-center mb-10">Past Successful Events</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($pastEvents as $event)
         <a href="{{ route('acara.show', $event->id) }}">

        <div class="bg-white shadow-md rounded-2xl overflow-hidden hover:-translate-y-1 transition">
          @if($event->Gambar)
            <img src="{{ asset('storage/'.$event->Gambar) }}" alt="{{ $event->Nama }}" class="w-full h-48 object-cover">
          @else
            <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
              <span class="text-white text-5xl">🎉</span>
            </div>
          @endif
          <div class="p-4">
            <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $event->Nama }}</h3>
            <p class="text-sm text-gray-600 line-clamp-3">{{ $event->Deskripsi }}</p>
            <p class="text-xs text-gray-400 mt-3">
              {{ \Carbon\Carbon::parse($event->Tanggal)->format('d M Y') }} — {{ $event->Lokasi }}
            </p>
          </div>
        </div>
         </a>
      @empty
        <div class="col-span-full text-center py-10">
          <p class="text-gray-500">No past events available</p>
        </div>
      @endforelse
    </div>
    <div class="text-center mt-8">
      <a href="{{ route('acara.index') }}" class="border border-purple-500 text-purple-600 hover:bg-purple-600 hover:text-white font-semibold px-6 py-2 rounded-full transition">Load More</a>
    </div>
  </section>
</div>
</x-default_layout>