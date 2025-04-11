<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

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
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'tanggal_penjualan')->with('user');

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id) . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan modal tambah penjualan
    public function create()
    {
        $user = UserModel::all();
        return view('penjualan.create', compact('user'));
    }

    // Menyimpan data
    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id' => 'required|exists:m_user,user_id',
                'pembeli' => 'required|string|min:3',
                'penjualan_kode' => 'required|string|min:5|unique:t_penjualan,penjualan_kode',
                'tanggal_penjualan' => 'required|date'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            PenjualanModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data penjualan berhasil disimpan'
            ]);
        }

        return redirect('/');
    }

    // Menampilkan detail penjualan
    public function show($id)
    {
        $penjualan = PenjualanModel::with('user')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    // Menampilkan halaman edit penjualan
    public function edit($id)
    {
        $penjualan = PenjualanModel::findOrFail($id);
        $user = UserModel::all();
        return view('penjualan.edit', compact('penjualan', 'user'));
    }

    // Menyimpan perubahan data penjualan
    public function update(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id' => 'required|exists:m_user,user_id',
                'pembeli' => 'required|string|min:3',
                'penjualan_kode' => 'required|string|min:5|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
                'tanggal_penjualan' => 'required|date'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            try {
                PenjualanModel::findOrFail($id)->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data penjualan berhasil diperbarui'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal memperbarui data'
                ]);
            }
        }

        return redirect('/');
    }

    // Menampilkan modal konfirmasi
    public function confirm($id)
    {
        $penjualan = PenjualanModel::findOrFail($id);
        return view('penjualan.confirm', compact('penjualan'));
    }

    // Menghapus data penjualan
    public function delete(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penjualan = PenjualanModel::find($id);

            if ($penjualan) {
                try {
                    $penjualan->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data gagal dihapus'
                    ]);
                }
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return redirect('/');
    }
}
