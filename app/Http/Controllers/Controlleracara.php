<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Controlleracara extends Controller
{
    public function index(Request $request)
    {
        // Start with base query
        $query = Acara::where('status', 'approved');

        // Filter by time range
        $timeFilter = $request->get('time', 'upcoming');
        $now = now();

        if ($timeFilter === 'this_week') {
            $query->whereBetween('Tanggal', [
                $now->copy()->startOfWeek(),
                $now->copy()->endOfWeek()
            ]);
        } elseif ($timeFilter === 'this_month') {
            $query->whereBetween('Tanggal', [
                $now->copy()->startOfMonth(),
                $now->copy()->endOfMonth()
            ]);
        } else {
            // upcoming - default, show future events
            $query->where('Tanggal', '>=', $now->toDateString());
        }

        // Filter by category
        $categoryFilter = $request->get('category');
        if ($categoryFilter && $categoryFilter !== 'all') {
            $query->where('Kategori', $categoryFilter);
        }

        // Sort by
        $sortBy = $request->get('sort', 'latest');
        if ($sortBy === 'oldest') {
            $query->orderBy('Tanggal', 'asc');
        } else {
            $query->orderBy('Tanggal', 'desc');
        }

        $acara = $query->get();

        // Get all categories for filter dropdown
        $categories = Acara::where('status', 'approved')->distinct()->pluck('Kategori')->sort();

        return view('event', compact('acara', 'categories', 'timeFilter', 'categoryFilter', 'sortBy'));
    }


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama' => 'required|max:255',
            'Deskripsi' => 'required',
            'Tanggal' => 'required|date',
            'Waktu' => 'required',
            'Lokasi' => 'required',
            'Kategori' => 'required',
            'Gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('Gambar')) {
            $validated['Gambar'] = $request->file('Gambar')->store('events', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending'; // Default pending

        Acara::create($validated);

        return redirect()->route('acara.index')->with('success', 'Event berhasil ditambahkan dan menunggu persetujuan admin');
    }

    /**
     * Tampilkan detail acara tertentu.
     * Menggunakan Route Model Binding untuk mendapatkan instance Acara.
     */
    public function show(Acara $acara)
    {
        // Model binding otomatis menangani pencarian acara, 
        // dan Acara::findOrFail($id) tidak lagi diperlukan.
        $acara->load('komentar');
        $komentar = $acara->komentar()->orderBy('created_at', 'desc')->get();

        return view('show', compact('acara', 'komentar'));
    }

    /**
     * Tampilkan form edit.
     * Menggunakan Route Model Binding.
     */
    public function edit(Acara $acara)
    {
        // Check ownership
        if (Auth::user()->role !== 'admin' && $acara->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('edit', compact('acara'));
    }

    /**
     * Proses update acara.
     * Menggunakan Route Model Binding.
     */
    public function update(Request $request, Acara $acara)
    {
        // Check ownership
        if (Auth::user()->role !== 'admin' && $acara->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'Nama' => 'required|max:255',
            'Deskripsi' => 'required',
            'Tanggal' => 'required|date',
            'Waktu' => 'required',
            'Lokasi' => 'required',
            'Kategori' => 'required',
            'Gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('Gambar')) {
            // Hapus gambar lama
            if ($acara->Gambar) {
                Storage::disk('public')->delete($acara->Gambar);
            }
            // Simpan gambar baru
            $validated['Gambar'] = $request->file('Gambar')->store('events', 'public');
        }

        // Reset status ke pending jika bukan admin yang mengedit
        if (Auth::user()->role !== 'admin') {
            $validated['status'] = 'pending';
        }

        $acara->update($validated);

        return redirect()->route('acara.show', $acara->id)->with('success', 'Event berhasil diupdate');
    }

    /**
     * Hapus acara.
     * Menggunakan Route Model Binding.
     */
    public function destroy(Acara $acara)
    {
        // Check ownership
        if (Auth::user()->role !== 'admin' && $acara->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($acara->Gambar) {
            Storage::disk('public')->delete($acara->Gambar);
        }

        $acara->delete();

        return redirect()->route('acara.index')->with('success', 'Event berhasil dihapus');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $acara = Acara::where('status', 'approved')
            ->where(function ($q) use ($query) {
                $q->where('Nama', 'like', "%{$query}%")
                    ->orWhere('Deskripsi', 'like', "%{$query}%")
                    ->orWhere('Lokasi', 'like', "%{$query}%")
                    ->orWhere('Kategori', 'like', "%{$query}%");
            })
            ->orderBy('Tanggal', 'desc')
            ->get();

        return view('search', compact('acara', 'query'));
    }
}