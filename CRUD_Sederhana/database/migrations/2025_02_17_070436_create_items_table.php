<?php

use Illuminate\Database\Migrations\Migration; // Mengimpor kelas Migration untuk membuat migrasi database
use Illuminate\Database\Schema\Blueprint; // Mengimpor kelas Blueprint untuk mendefinisikan struktur tabel
use Illuminate\Support\Facades\Schema; // Mengimpor kelas Schema untuk mengelola tabel di database

return new class extends Migration // Mendefinisikan kelas anonim yang mewarisi Migration
{
    public function up(): void // Method ini dieksekusi saat menjalankan migrasi (php artisan migrate)
    {
        Schema::create('items', function (Blueprint $table) { // Membuat tabel 'items' di database
            $table->id(); // Membuat kolom 'id' sebagai primary key dengan tipe data big integer auto-increment
            $table->string('name'); // Membuat kolom 'name' dengan tipe data string
            $table->text('description'); // Membuat kolom 'description' dengan tipe data text
            $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at' secara otomatis
        });
    }

    public function down(): void // Method ini dieksekusi saat rollback migrasi (php artisan migrate:rollback)
    {
        Schema::dropIfExists('items'); // Menghapus tabel 'items' jika ada
    }
};
