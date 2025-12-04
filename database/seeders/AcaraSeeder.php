<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acara;
use Carbon\Carbon;

class AcaraSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'Nama' => 'Sulteng Coffee Fest 2025',
                'Tanggal' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'Waktu' => '09:00:00',
                'Lokasi' => 'Atrium Palu Grand Mall',
                'Deskripsi' => 'Festival kopi terbesar di Sulawesi Tengah. Nikmati berbagai jenis kopi lokal dan kuliner khas Palu.',
                'Kategori' => 'Entertainment',
                'Gambar' => null,
                'user_id' => 1, // Admin user
                'status' => 'approved'
            ],
            [
                'Nama' => 'Tiba-tiba ECKO SHOW hadir di PALU!',
                'Tanggal' => Carbon::now()->subDays(30)->format('Y-m-d'),
                'Waktu' => '19:00:00',
                'Lokasi' => 'Lapangan Vatulemo Palu',
                'Deskripsi' => 'Dalam rangka memperingati Hari Sumpah Pemuda, siap-siap ketemu langsung sama sosok penuh energi ini!',
                'Kategori' => 'Music',
                'Gambar' => null,
                'user_id' => 1,
                'status' => 'approved'
            ],
            [
                'Nama' => 'Pagelaran Budaya 2025',
                'Tanggal' => Carbon::now()->subDays(20)->format('Y-m-d'),
                'Waktu' => '18:00:00',
                'Lokasi' => 'Gedung SMAN 2 Palu',
                'Deskripsi' => 'Sanggar Seni KUAS SMAN 2 Palu mempersembahkan "Lentera Andalas". Pertunjukan seni budaya tradisional Sulawesi Tengah.',
                'Kategori' => 'Entertainment',
                'Gambar' => null,
                'user_id' => 1,
                'status' => 'approved'
            ],
            [
                'Nama' => 'Berdamai dengan Overthinking',
                'Tanggal' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'Waktu' => '14:00:00',
                'Lokasi' => 'Aula Universitas Tadulako',
                'Deskripsi' => 'Kelas healing untuk menemukan motivasi dan ketenangan hati. Bersama psikolog profesional.',
                'Kategori' => 'Education',
                'Gambar' => null,
                'user_id' => 1,
                'status' => 'approved'
            ],
            [
                'Nama' => 'Workshop Digital Marketing 2025',
                'Tanggal' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'Waktu' => '13:00:00',
                'Lokasi' => 'Hotel Mercure Palu',
                'Deskripsi' => 'Pelajari strategi digital marketing terkini untuk mengembangkan bisnis Anda di era digital.',
                'Kategori' => 'Business',
                'Gambar' => null,
                'user_id' => 2, // Regular user
                'status' => 'approved'
            ],
            [
                'Nama' => 'Turnamen Futsal Antar Kampus',
                'Tanggal' => Carbon::now()->addDays(20)->format('Y-m-d'),
                'Waktu' => '08:00:00',
                'Lokasi' => 'GOR Universitas Tadulako',
                'Deskripsi' => 'Kompetisi futsal antar mahasiswa se-Palu. Hadiah jutaan rupiah untuk pemenang!',
                'Kategori' => 'Sports',
                'Gambar' => null,
                'user_id' => 2,
                'status' => 'approved'
            ],
            [
                'Nama' => 'Music Festival 2025',
                'Tanggal' => Carbon::now()->addDays(30)->format('Y-m-d'),
                'Waktu' => '16:00:00',
                'Lokasi' => 'Pantai Talise Palu',
                'Deskripsi' => 'Festival musik dengan lineup band-band ternama dari seluruh Indonesia. Live music performance hingga malam.',
                'Kategori' => 'Music',
                'Gambar' => null,
                'user_id' => 1,
                'status' => 'approved'
            ],
            [
                'Nama' => 'Seminar Kewirausahaan',
                'Tanggal' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'Waktu' => '09:00:00',
                'Lokasi' => 'Auditorium UNTAD',
                'Deskripsi' => 'Belajar memulai bisnis dari nol bersama pengusaha sukses. Gratis untuk mahasiswa!',
                'Kategori' => 'Business',
                'Gambar' => null,
                'user_id' => 2,
                'status' => 'approved'
            ],
            // Event pending untuk testing
            [
                'Nama' => 'Event Pending Test',
                'Tanggal' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'Waktu' => '10:00:00',
                'Lokasi' => 'Test Location',
                'Deskripsi' => 'Event ini masih pending approval dari admin.',
                'Kategori' => 'Education',
                'Gambar' => null,
                'user_id' => 2,
                'status' => 'pending'
            ]
        ];

        foreach ($events as $event) {
            Acara::create($event);
        }
    }
}