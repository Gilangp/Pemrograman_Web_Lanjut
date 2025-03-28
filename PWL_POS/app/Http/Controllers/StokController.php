<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stok = StokModel::all();
        return view('stok.index', ['data' => $stok]);
    }

    // tambah data
    public function tambah()
    {
        return view('stok.stok_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        StokModel::create([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah
        ]);

        return redirect('/stok');
    }

    // ubah data
    public function ubah($id)
    {
        $stok = StokModel::find($id);
        return view('stok.stok_ubah', ['data' => $stok]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $stok = StokModel::find($id);

        $stok->barang_id = $request->barang_id;
        $stok->user_id = $request->user_id;
        $stok->stok_tanggal = $request->stok_tanggal;
        $stok->stok_jumlah = $request->stok_jumlah;

        $stok->save();

        return redirect('/stok');
    }

    // hapus data
    public function hapus($id)
    {
        $stok = StokModel::find($id);
        $stok->delete();

        return redirect('/stok');
    }
}
