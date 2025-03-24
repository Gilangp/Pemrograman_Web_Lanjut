<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_supplier')->insert([
            [
                'supplier_kode' => 'SUP01',
                'supplier_nama' => 'PT Sumber Berkah',
                'supplier_alamat' => 'Jl. Hayam Wuruk No. 20, Kediri',
                'no_telepon' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_kode' => 'SUP02',
                'supplier_nama' => 'CV Makmur Jaya',
                'supplier_alamat' => 'Jl. Ijen Boulevard No. 15, Malang',
                'no_telepon' => '085678901234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_kode' => 'SUP03',
                'supplier_nama' => 'UD Sejahtera',
                'supplier_alamat' => 'Jl. Ahmad Yani No. 30, Surabaya',
                'no_telepon' => '087654321098',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
