<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi'); // ✅ Ubah dari string ke text
            $table->foreignId('id_event')->constrained('acara')->onDelete('cascade'); // ✅ Tambah foreign key
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // ✅ Tambah user_id
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("komentar");
    }
};