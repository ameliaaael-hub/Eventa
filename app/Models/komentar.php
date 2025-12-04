<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';

    protected $fillable = [
        'nama',
        'deskripsi',
        'id_event',
        'user_id' // ✅ Tambahkan user_id
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'id_event');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}