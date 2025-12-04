<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controllerkomentar extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'id_event' => 'required|integer'
        ]);

        Komentar::create([
            'nama' => Auth::user()->name,
            'deskripsi' => $request->deskripsi,
            'id_event' => $request->id_event,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('acara.show', $request->id_event)->with('success', 'Comment posted successfully!');
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        
        // Check if user owns the comment or is admin
        if (Auth::user()->role !== 'admin' && $komentar->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $eventId = $komentar->id_event;
        $komentar->delete();

        return redirect()->route('acara.show', $eventId)->with('success', 'Comment deleted!');
    }
}