<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $pendingEvents = Acara::where('status', 'pending')->with('user')->latest()->get();
        $approvedEvents = Acara::where('status', 'approved')->with('user')->latest()->get();
        $rejectedEvents = Acara::where('status', 'rejected')->with('user')->latest()->get();

        return view('admin', compact('pendingEvents', 'approvedEvents', 'rejectedEvents'));
    }

    public function approve($id)
    {
        $acara = Acara::findOrFail($id);
        $acara->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Event berhasil disetujui');
    }

    public function reject($id)
    {
        $acara = Acara::findOrFail($id);
        $acara->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Event ditolak');
    }

    public function destroy($id)
    {
        $acara = Acara::findOrFail($id);

        // Delete image if exists
        if ($acara->Gambar) {
            Storage::disk('public')->delete($acara->Gambar);
        }

        $acara->delete();

        return redirect()->back()->with('success', 'Event berhasil dihapus');
    }
}