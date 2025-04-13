<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        // total omset penjualan
        $omsetPenjualan = PenjualanModel::with('penjualanDetail')
            ->get()
            ->sum(function ($penjualan) {
                return $penjualan->penjualanDetail->sum(function ($detail) {
                    return $detail->jumlah * $detail->harga;
                });
            });

        // top 3 barang terlaris
        $topBarang = PenjualanModel::join('t_penjualan_detail', 't_penjualan.penjualan_id', '=', 't_penjualan_detail.penjualan_id')
            ->join('m_barang', 't_penjualan_detail.barang_id', '=', 'm_barang.barang_id')
            ->select('m_barang.barang_nama', DB::raw('sum(t_penjualan_detail.jumlah) as total_terjual'))
            ->groupBy('m_barang.barang_nama')
            ->orderByDesc('total_terjual')
            ->take(3)
            ->get();

        return view('welcome', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'omsetPenjualan' => $omsetPenjualan,
            'topBarang' => $topBarang
        ]);
    }
}
