<?php

namespace App\Models; // Mendefinisikan namespace untuk model Item agar sesuai dengan struktur Laravel

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk mendukung pembuatan factory pada model ini
use Illuminate\Database\Eloquent\Model; // Mengimpor kelas Model dari Laravel untuk membuat model Eloquent

class Item extends Model // Mendefinisikan kelas Item yang merupakan turunan dari Model Laravel
{
    use HasFactory; // Menggunakan trait HasFactory untuk memungkinkan pembuatan data dummy dengan factory

    protected $fillable = [ // Menentukan atribut yang boleh diisi secara massal (mass assignment)
        'name', // Atribut 'name' bisa diisi saat menggunakan metode create() atau update() di Eloquent
        'description', // Atribut 'description' juga bisa diisi secara massal
    ];
}
