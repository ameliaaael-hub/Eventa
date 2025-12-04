<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Komentar;

class KomentarSeeder extends Seeder
{
    public function run(): void
    {
        $komentars = [
            [
                'nama' => 'Admin',
                'deskripsi' => 'Event yang sangat menarik! Sangat terorganisir dengan baik. Terima kasih panitia!',
                'id_event' => 1,
                'user_id' => 1
            ],
            [
                'nama' => 'User Test',
                'deskripsi' => 'Pertama kali ikut event seperti ini, pengalaman yang luar biasa. Recommended!',
                'id_event' => 1,
                'user_id' => 2
            ],
            [
                'nama' => 'Admin',
                'deskripsi' => 'ECKO SHOW keren banget! Energinya luar biasa, penonton pada heboh semua!',
                'id_event' => 2,
                'user_id' => 1
            ],
            [
                'nama' => 'User Test',
                'deskripsi' => 'Pagelaran budaya yang memukau. Bangga dengan budaya lokal kita!',
                'id_event' => 3,
                'user_id' => 2
            ],
            [
                'nama' => 'Admin',
                'deskripsi' => 'Workshop yang sangat bermanfaat. Materinya mudah dipahami dan aplikatif.',
                'id_event' => 5,
                'user_id' => 1
            ]
        ];

        foreach ($komentars as $komentar) {
            Komentar::create($komentar);
        }
    }
}