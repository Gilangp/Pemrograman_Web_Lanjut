@extends('layouts.template')

@section('content')

<!-- Row untuk Omset Penjualan dan Top 3 Produk -->
<div class="row">
    <!-- Omset Penjualan -->
    <div class="col-md-6 col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title" style="font-size: 1.5rem;">Omset Penjualan</h3>
            </div>
            <div class="card-body text-center">
                <p class="display-4" style="font-size: 2rem;">Rp {{ number_format($omsetPenjualan, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Top 3 Penjualan Terlaris -->
    <div class="col-md-6 col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title" style="font-size: 1.5rem;">Top 3 Penjualan Terlaris</h3>
            </div>
            <div class="card-body">
                <ul class="list-unstyled" style="font-size: 1rem;">
                    @foreach ($topBarang as $barang)
                        <li><span class="badge bg-info"></span> {{ $barang->barang_nama }} - {{ $barang->total_terjual }} Terjual</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
