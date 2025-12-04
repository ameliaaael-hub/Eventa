<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Controlleracara extends Controller
{
    public function index()
    {
        // Hanya tampilkan event yang sudah approved
        $acara = Acara::where('status', 'approved')
            ->orderBy('Tanggal', 'desc')
            ->get();

        return view('event', compact('acara'));
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

    public function show($id)
    {
        $acara = Acara::with('komentar')->findOrFail($id);
        $komentar = $acara->komentar()->orderBy('created_at', 'desc')->get();

        return view('show', compact('acara', 'komentar'));
    }

    public function edit($id)
    {
        $acara = Acara::findOrFail($id);

        // Check ownership
        if (Auth::user()->role !== 'admin' && $acara->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('edit', compact('acara'));
    }

    public function update(Request $request, $id)
    {
        $acara = Acara::findOrFail($id);

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
            if ($acara->Gambar) {
                Storage::disk('public')->delete($acara->Gambar);
            }
            $validated['Gambar'] = $request->file('Gambar')->store('events', 'public');
        }

        // Reset status ke pending jika bukan admin
        if (Auth::user()->role !== 'admin') {
            $validated['status'] = 'pending';
        }

        $acara->update($validated);

        return redirect()->route('acara.show', $acara->id)->with('success', 'Event berhasil diupdate');
    }

    public function destroy($id)
    {
        $acara = Acara::findOrFail($id);

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