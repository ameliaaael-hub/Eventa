<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    protected $table = 'acara';

    protected $fillable = [
        'Nama',
        'Deskripsi',
        'Tanggal',
        'Waktu',
        'Lokasi',
        'Kategori',
        'Gambar',
        'user_id',
        'status'
    ];

    protected $casts = [
        'Tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_event');
    }
}