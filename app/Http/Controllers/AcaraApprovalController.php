<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Acara;

class AcaraApprovalController extends Controller
{
    public function index()
    {
        $pendingEvents = Acara::pending()->with('user')->latest()->get();
        return view('admin.acara.index', compact('pendingEvents'));
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
}