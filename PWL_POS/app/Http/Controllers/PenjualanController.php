<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        // Menampilkan halaman daftar Penjualan
        $breadcrumb = (object)[
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object)[
            'title' => 'Daftar penjualan dalam sistem'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data penjualan dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'tanggal_penjualan')
            ->with('user')
            ->withSum('penjualanDetail as total_harga', DB::raw('harga * jumlah'));

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('total_harga', function ($penjualan) {
                return 'Rp ' . number_format($penjualan->total_harga, 0, ',', '.');
            })
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id) . '\')" class="btn btn-info btn-sm">Detail</button> ';
                // $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan modal tambah penjualan
    public function create()
    {
        $user = Auth::user();
        $barang = BarangModel::all();
        $kodePenjualan = 'PNJ-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        return view('penjualan.create', ['user' => $user, 'barang' => $barang, 'kodePenjualan' => $kodePenjualan]);
    }

    // Menyimpan data
    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id' => 'required|exists:m_user,user_id',
                'pembeli' => 'required|string|max:100',
                'penjualan_kode' => 'required|unique:t_penjualan,penjualan_kode',
                'tanggal_penjualan' => 'required|date',
                'barang_id' => 'required|array',
                'barang_id.*' => 'exists:m_barang,barang_id',
                'harga' => 'required|array',
                'jumlah' => 'required|array',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            // cek stok
            foreach ($request->barang_id as $i => $barang_id) {
                $stok = StokModel::where('barang_id', $barang_id)->first();

                if ($stok) {
                    $jumlah_dibeli = $request->jumlah[$i];

                    if ($stok->stok_jumlah <= 0) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Stok barang ' . $stok->barang->barang_nama . ' sudah habis.'
                        ]);
                    }

                    if ($jumlah_dibeli > $stok->stok_jumlah) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Jumlah yang dibeli melebihi stok untuk barang ' . $stok->barang->barang_nama . '. Stok tersedia: ' . $stok->stok_jumlah
                        ]);
                    }

                    $stok->stok_jumlah -= $jumlah_dibeli;
                    $stok->save();
                } else {
                    $barang = BarangModel::find($barang_id);
                    return response()->json([
                        'status' => false,
                        'message' => 'Barang dengan ID ' . $barang_id . ' dengan nama ' . $barang->barang_nama . ' tidak ditemukan dalam stok.'
                    ]);
                }
            }

            // penyimpanan di penjualan
            $penjualan = PenjualanModel::create([
                'user_id' => $request->user_id,
                'pembeli' => $request->pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'tanggal_penjualan' => $request->tanggal_penjualan,
            ]);

            // penyimpanan di penjualandetail
            foreach ($request->barang_id as $i => $barang_id) {
                $penjualan->penjualanDetail()->create([
                    'penjualan_id' => $penjualan->penjualan_id,
                    'barang_id' => $barang_id,
                    'harga' => $request->harga[$i],
                    'jumlah' => $request->jumlah[$i],
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data penjualan berhasil disimpan'
            ]);
        }
    }

    // Menampilkan detail penjualan
    public function show($id)
    {
        $penjualan = PenjualanModel::with('user')->findOrFail($id);
        return view('penjualan.show', ['penjualan' => $penjualan]);
    }

    // Menampilkan halaman edit penjualan
    // public function edit($id)
    // {
    //     $penjualan = PenjualanModel::findOrFail($id);
    //     $user = UserModel::all();
    //     return view('penjualan.edit', ['penjualan' => $penjualan, 'user' => $user]);
    // }

    // Menyimpan perubahan data penjualan
    // public function update(Request $request, $id)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'user_id' => 'required|exists:m_user,user_id',
    //             'pembeli' => 'required|string|min:3',
    //             'penjualan_kode' => 'required|string|min:5|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
    //             'tanggal_penjualan' => 'required|date'
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validasi gagal',
    //                 'msgField' => $validator->errors()
    //             ]);
    //         }

    //         try {
    //             PenjualanModel::findOrFail($id)->update($request->all());

    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Data penjualan berhasil diperbarui'
    //             ]);
    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Gagal memperbarui data'
    //             ]);
    //         }
    //     }

    //     return redirect('/');
    // }

    // Menampilkan modal konfirmasi
    public function confirm($id)
    {
        $penjualan = PenjualanModel::findOrFail($id);
        return view('penjualan.confirm', ['penjualan' => $penjualan]);
    }

    // Menghapus data penjualan
    public function delete(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penjualan = PenjualanModel::find($id);

            if ($penjualan) {
                try {
                    // hapus data di detil penjualan dulu
                    $penjualan->penjualanDetail()->delete();

                    // hapus data penjualan utama
                    $penjualan->delete();

                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data gagal dihapus: ' . $e->getMessage()
                    ]);
                }
            }

            return response()->json([
                'status' => false,
                'message' => 'Data penjualan tidak ditemukan'
            ]);
        }

        return redirect('/');
    }

    // export pdf
    public function export_pdf($id)
    {
        $penjualan = PenjualanModel::with(['user', 'penjualanDetail.barang'])->findOrFail($id);

        $pdf = Pdf::loadView('penjualan.export_pdf', ['penjualan' => $penjualan]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption("isRemoteEnabled", true);

        return $pdf->stream('Penjualan-' . $penjualan->penjualan_kode . '-' . date('Ymd_His') . '.pdf');
    }
}
