<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\DB;

class KetegoriController extends Controller
{
    public function index()
    {
        $data = KategoriModel::all();
        return view('kategori.index', ['data' => $data]);
    }

    // add data
    public function tambah()
    {
        return view('kategori.kategori_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori');
    }

    // ubah data
    public function ubah($id)
    {
        $data = KategoriModel::find($id);
        return view('kategori.kategori_ubah', ['data' => $data]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $kategori = KategoriModel::find($id);

        $kategori->kategori_kode = $request->kategori_kode;
        $kategori->kategori_nama = $request->kategori_nama;

        $kategori->save();

        return redirect('/kategori');
    }

    // hapus data
    public function hapus($id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->delete();

        return redirect('/kategori');
    }
}
